<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปรายรับรายจ่ายประจำเดือน</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container mt-2">
        <div class="row">
            <div class="container mt-4">
                <h1 class="mb-4">สรุปรายรับรายจ่ายประจำเดือน</h1>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">รายรับทั้งหมด</h5>
                                <p class="card-text text-success fs-4">฿{{ number_format($totalIncome ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">รายจ่ายทั้งหมด</h5>
                                <p class="card-text text-danger fs-4">฿{{ number_format($totalExpenses ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">ยอดคงเหลือ</h5>
                                <p class="card-text text-primary fs-4">฿{{ number_format($balance ?? 0, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="card mt-3 mb-3">
            <div class="card-body">
                <h5 class="card-title">ค้นหารายการ</h5>
                <form class="row g-3" action="{{ route('companies.index') }}" method="GET">
                    <div class="col-md-4">
                        <select name="month" class="form-select" aria-label="เลือกเดือน">
                            <option value="" selected>เลือกเดือน</option>
                            <option value="1">มกราคม</option>
                            <option value="2">กุมภาพันธ์</option>
                            <option value="3">มีนาคม</option>
                            <option value="4">เมษายน</option>
                            <option value="5">พฤษภาคม</option>
                            <option value="6">มิถุนายน</option>
                            <option value="7">กรกฎาคม</option>
                            <option value="8">สิงหาคม</option>
                            <option value="9">กันยายน</option>
                            <option value="10">ตุลาคม</option>
                            <option value="11">พฤศจิกายน</option>
                            <option value="12">ธันวาคม</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">ค้นหา</button>
                    </div>
                </form>
                
            </div>
        </div>
        
        <div class="btn mb-3">
            <a href="{{ route('companies.create') }}" class="btn btn-success">เพิ่มรายการ</a>
        </div>

        @if ($message = Session::get('success'))
            <div class="row mb-3">
                <div class="col-md-12 text-center">
                    <div class="alert alert-success" style="font-size: 20px;">
                        <p>{{ $message }}</p>
                    </div>
                </div>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th class="text-center">No.</th>
                <th class="text-center">วันที่ใช้จ่าย</th>
                <th class="text-center">ประเภท</th>
                <th class="text-center">รายการ</th>
                <th class="text-center">จำนวนเงิน</th>
                <th class="text-center">วันเวลาที่บันทึกข้อมูล</th>
                <th class="text-center">วันเวลาที่ปรับปรุงข้อมูลล่าสุด</th>
                <th class="text-center" width="280px">การดำเนินการ</th>
            </tr>
            @foreach($companies as $company)
                <tr>
                    <td class="text-center">{{ $loop->iteration + ($companies->currentPage() - 1) * $companies->perPage() }}</td>
                    <td class="text-center">{{ $company->date }}</td>
                    <td class="text-center">
                        @if ($company->transaction_type === 'รายรับ')
                            <span class="badge bg-success">{{ $company->transaction_type }}</span> 
                        @elseif ($company->transaction_type === 'รายจ่าย')
                            <span class="badge bg-danger">{{ $company->transaction_type }}</span> 
                        @else
                            {{ $company->transaction_type }} 
                        @endif
                    </td>
                    <td class="text-center">{{ $company->list }}</td>
                    <td class="text-center">{{ number_format($company->amount, 2) }}</td>
                    <td class="text-center">{{ $company->created_at }}</td>
                    <td class="text-center">{{ $company->updated_at }}</td>
                    <td class="text-center align-middle">
                        <form action="{{ route('companies.destroy', $company->id) }}" method="POST">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-warning">แก้ไข</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">ลบ</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
        
        {!! $companies->links('pagination::bootstrap-5') !!}
    </div>
</body>
</html>
