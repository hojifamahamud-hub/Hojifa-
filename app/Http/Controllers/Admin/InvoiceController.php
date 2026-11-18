<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $userId = $request->query('user');

        $invoices = Invoice::query()->with(['user', 'clientProject'])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($userId, fn ($query) => $query->where('user_id', $userId))
            ->orderByDesc('id')
            ->paginate(50)
            ->withQueryString();

        $clients = User::query()->where('role', User::ROLE_CLIENT)->orderBy('name')->get();

        return view('admin.invoices.index', compact('invoices', 'clients', 'status', 'userId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['number'] = $this->nextNumber();
        $invoice = Invoice::create($this->normalize($data));
        $this->recalculate($invoice);

        return redirect()->route('admin.invoices.index')->with('success', __('site.admin.saved'));
    }

    public function update(Request $request, Invoice $invoice)
    {
        $invoice->update($this->normalize($request->validate($this->rules())));
        $this->recalculate($invoice);

        return redirect()->back()->with('success', __('site.admin.updated'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('success', __('site.admin.deleted'));
    }

    public function voucher(Invoice $invoice)
    {
        $invoice->load(['user', 'payments' => fn ($q) => $q->where('status', Payment::STATUS_APPROVED)]);

        return view('admin.invoices.voucher', compact('invoice'));
    }

    protected function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'client_project_id' => ['nullable', 'exists:client_projects,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'currency' => ['nullable', 'string', 'max:3'],
            'note' => ['nullable', 'string'],
            'due_date' => ['nullable', 'date'],
        ];
    }

    protected function normalize(array $data): array
    {
        $data['paid_amount'] = 0;
        $data['status'] = Invoice::STATUS_UNPAID;
        $data['currency'] = $data['currency'] ?? 'BDT';

        return $data;
    }

    protected function nextNumber(): string
    {
        $i = (int) Invoice::query()->max('id') + 1;

        do {
            $number = 'INV-'.str_pad((string) $i, 5, '0', STR_PAD_LEFT);
            $exists = Invoice::query()->where('number', $number)->exists();
            $i++;
        } while ($exists);

        return $number;
    }

    public static function recalculate(Invoice $invoice): void
    {
        $paid = (float) $invoice->payments()->where('status', Payment::STATUS_APPROVED)->sum('amount');
        $invoice->paid_amount = $paid;
        $invoice->status = match (true) {
            $paid <= 0 => Invoice::STATUS_UNPAID,
            $paid >= (float) $invoice->amount => Invoice::STATUS_PAID,
            default => Invoice::STATUS_PARTIAL,
        };
        $invoice->save();
    }
}
