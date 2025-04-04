<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Invoice - {{ $user->name }}</title>
    <style>
        @page {
            size: A4;
            margin: 20px;
        }
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f8f9fa;
            font-size: 12px;
        }
        .invoice-container {
            max-width: 80%;
            padding: 20px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #2c3e50;
            margin: 0;
            font-size: 28px;
        }
        .header p {
            color: #7f8c8d;
            margin: 5px 0;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            page-break-inside: avoid; 

        }
        .bill-to {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin: 25px 0;
            page-break-inside: avoid; 

        }
        .details-table th {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: left;
        }
        .details-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        .total-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin-top: 25px;
            page-break-before: avoid;
        }
        .download-btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background 0.3s ease;
        }
        .download-btn:hover {
            background: #2980b9;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .highlight {
            color: #2ecc71;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h1>Automated Payroll System</h1>
            <p>Halishahar, Chattogram | 01827829281</p>
            <p>Monthly Salary Invoice</p>
        </div>

        <div class="invoice-info">
            <div>
                <h3>Employee Details</h3>
                <div class="bill-to">
                    <p><strong>{{ $user->name }}</strong></p>
                    <p>{{ $user->position }}</p>
                    <p>Joined: {{ $user->date_of_join }}</p>
                </div>
            </div>
            <div>
                <h3>Invoice Details</h3>
                <p><strong>Issue Date:</strong> {{ now()->format('d M Y') }}</p>
                <p><strong>Payment Status:</strong> <span class="highlight">Paid</span></p>
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>Component</th>
                    <th class="text-right">Amount (BDT)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Base Salary</td>
                    <td class="text-right">{{ number_format($record->salary, 2) }}</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td class="text-right">{{ number_format($record->bonus, 2) }}</td>
                </tr>
                <tr>
                    <td>Deductions</td>
                    <td class="text-right">-{{ number_format($record->deduction, 2) }}</td>
                </tr>
                <tr>
                    <td>Fines</td>
                    <td class="text-right">-{{ number_format($record->fine, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Gross Salary</strong></td>
                    <td class="text-right"><strong>{{ number_format($record->payroll, 2) }}</strong></td>
                </tr>
                <tr>
                    <td>Tax ({{ $record->tax_rate }}%)</td>
                </tr>
                <tr style="background: #f8f9fa;">
                    <td><strong>Net Payable</strong></td>
                    <td class="text-right highlight">{{ number_format($record->payable_salary, 2) }}</td>
                </tr>
            </tbody>
        </table>


        <div class="footer" style="margin-top: 30px; text-align: center; color: #95a5a6;">
            <p>This is an auto-generated invoice. For any queries, contact accounts department.</p>
            <p>Thank you for your dedicated service!</p>
        </div>
    </div>
</body>
</html>