<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มรายรับรายจ่าย</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>เพิ่มรายรับรายจ่าย</h2>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <label for="transaction_type"><strong>ประเภท</strong></label>
                        <select name="transaction_type" class="form-control" required>
                            <option value="">-- เลือกประเภท --</option>
                            <option value="รายรับ" {{ old('transaction_type') === 'รายรับ' ? 'selected' : '' }}>รายรับ</option>
                            <option value="รายจ่าย" {{ old('transaction_type') === 'รายจ่าย' ? 'selected' : '' }}>รายจ่าย</option>
                        </select>
                        @error('transaction_type')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group my-3">
                        <label for="list"><strong>รายการ</strong></label>
                        <input type="text" name="list" class="form-control" placeholder="ระบุ รายการ" value="{{ old('list') }}" required>
                        @error('list')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group my-3">
                        <label for="amount"><strong>จำนวนเงิน</strong></label>
                        <input type="number" name="amount" class="form-control" placeholder="ระบุ จำนวนเงิน" min="0" step="0.01" value="{{ old('amount') }}" required>
                        @error('amount')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group my-3">
                        <label for="date"><strong>วันที่</strong></label>
                        <input type="date" name="date" class="form-control" value="{{ old('date') }}" required>
                        @error('date')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <a href="{{ route('companies.index') }}" class="btn btn-secondary mt-3 ms-2">กลับ</a>
                    <button type="submit" class="btn btn-primary mt-3">เพิ่มรายการ</button>
                </div>
            </div>
        </form>
    </div>

</body>
</html>
