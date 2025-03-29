<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 90%; margin: 20px auto; }
        .header, .footer { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Ayesha Tution Center & Cooking House</h2>
            <p>Halisohor, Chattogram</p>
            <p>018278292811</p>
        </div>

        <h3>Invoice</h3>
        <p><strong>Invoice No:</strong> Hello</p>
        <p><strong>Date:</strong> How</p>
        <p><strong>Due Date:</strong> are</p>
        <p><strong>Status:</strong> you</p>

        <h4>Bill To:</h4>
        <p>{{$user->name}}</p>
        <p>{{ $user->address }}</p>
      
        <table>
            <thead>
                <tr>
                    <th>Base Salary with Allowance</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Fine</th>
                    <th>Salary Before Tax</th>
                    <th>Tax Rate</th>
                    <th>Salary After Tax</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ number_format($record->salary, 2) }}</td>
                    <td>{{ number_format($record->bonus, 2) }}</td>
                    <td>{{ number_format($record->deduction, 2) }}</td>
                    <td>{{ number_format($record->fine, 2) }}</td>
                    <td>{{ number_format($record->payroll, 2) }}</td>
                    <td>{{ number_format($record->tax_rate, 2) }}</td>
                    <td>{{ number_format($record->payable_salary, 2) }}</td>
                </tr>
            </tbody>
        </table>
{{-- 
        <h4>Invoice Summary</h4>
        <p><strong>Subtotal:</strong> ${{ number_format($invoiceData['subtotal'], 2) }}</p>
        <p><strong>Sales Tax:</strong> ${{ number_format($invoiceData['tax'], 2) }}</p>
        <p><strong>Total:</strong> ${{ number_format($invoiceData['total'], 2) }}</p>
        <p><strong>Payment:</strong> ${{ number_format($invoiceData['payment'], 2) }}</p>
        <p><strong>Balance Due:</strong> $0.00</p> --}}

        <div class="footer">
            <p>We appreciate your service.</p>
        </div>
    </div>
</body>
</html>
