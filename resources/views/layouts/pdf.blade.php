<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Monthy Slip of {{ $user->employee_name }}</title>
</head>
<style>
		@font-face{ 
			font-family: ipag; 
			font-style: normal; 
			font-weight: normal; 
			src:url("{{ storage_path('fonts/ipag.ttf')}}"); 
			}
			body { font-family: ipag; }
			hr 
			{ 
				width: 140%; 
				margin-left: 0px;
			}
			td{
				padding-right: 40px;
			}
</style>
<body>
    <h1>Official Report for Monthly Salary</h1>
    <div>As of {{ $date }}</div>
    <div>Received with thanks from GIC Co.,Ltd.</div>
    <div>For the month of {{ $monthYear }}</div>
    <table>
        <tbody>
            <tr>
                <td>集計</td>
                <td>
                    {{ $user->working_hours }} 時間
                </td>
            </tr>
            <tr>
                <td>
                    事前研修時間数※初期の身
                </td>
                <td>
                    {{ $user->pre_training_hours }}
                </td>
            </tr>
            <tr>
                <td>
                    会議出席
                </td>
                <td>
                    {{ $user->pre_training_hours }}
                </td>
            </tr>
            <tr>
                <td>
                    Leader 手当※会議出席含み
                </td>
                <td>
                    {{ $user->pre_training_hours }}
                </td>
            </tr>
            <tr>
                <td>
                    作業時間数
                </td>
                <td>
                    {{ $user->working_hours }}
                </td>
            </tr>
            <tr>
                <td>
                    Cross Check
                </td>
                <td>
                    {{ $user->working_hours }}
                </td>
            </tr>
            <tr>
                <td>
                    修正作業時間
                </td>
                <td>
                    {{ $user->correction_work_time }}
                </td>
            </tr>
            <tr>
                <td>
                    基本時給※単価：円
                </td>
                <td>
                    {{ $user->payment_amount_with_yen	 }}(￥)
                </td>
            </tr>
            <tr>
                <td>
                    Incentives※単価：生産性による
                </td>
                <td>
                    {{ $user->payment_amount_with_yen	 }}(￥)
                </td>
            </tr>
            <tr>
                <td>
                    支給額※単価:円
                </td>
                <td>
                    {{ $user->leader_allowance }}(￥)
                </td>
            </tr>
   			<hr />
            <tr>
                <td>
                    レード  {{ $user->yarn_rate }}　(￥)
                </td>
                <td>
                    {{ $user->usd_rate }}USD
                </td>
            </tr>
            <tr>
                <td>
                    レード  {{ $user->usd_rate }}　MMK
                </td>
            </tr>
            <tr>
                <td>
                    支給合計額
                </td>
            </tr><br>
            <tr>
                <td>
                    Name :
                </td>
                <td>
				{{ $user->employee_name }}
                </td>
            </tr>
            <tr>
                <td>
                    Employee Number:
                </td>
                <td>
				{{ $user->employee_id }}
                </td>
            </tr>
            <tr>
                <td>
                    NRC Number:
                </td>
                <td>
				{{ $user->employee_nrc_number }}
                </td>
            </tr>
            <tr>
                <td>
                    Signature:
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
