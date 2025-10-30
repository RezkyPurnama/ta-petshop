@extends('user.layouts.main')

@section('content')
    <style>
        .card-custom {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.06);
        }

        .form-label {
            font-weight: 600;
        }

        .btn-checkout {
            background-color: #ffc107;
            color: #000;
            font-weight: 600;
            transition: 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #e0a800;
            color: #fff;
        }

        .summary-box .label {
            font-weight: 500;
            color: #6c757d;
        }

        .summary-box .value {
            font-weight: 700;
        }

        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4f46e5;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            display: none;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .results-container {
            display: none;
        }
    </style>
    <div class="container-fluid bg-primary hero-header py-5 mb-3"></div>
    <div class="container pb-5">
        <h1 class="text-center mb-5">Checkout</h1>

        {{-- Tambahkan di sini --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

        <form id="checkout-form" action="{{ route('pesanan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="ongkir" id="ongkir" value="0">

            <div class="row g-4">
                <!-- FORM DETAIL -->
                <div class="col-lg-7">
                    <div class="card card-custom p-4">
                        <h5 class="fw-bold mb-4">Detail Pembayaran</h5>

                        <div class="mb-3">
                            <label for="nama_penerima" class="form-label">Nama</label>
                            <input type="text" name="nama_penerima" id="nama_penerima" class="form-control"
                                value="{{ old('nama_penerima', Auth::user()->name) }}">
                            @error('nama_penerima')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat Pengiriman</label>
                            <input type="text" name="alamat" id="alamat" class="form-control"
                                value="{{ old('alamat', Auth::user()->alamat) }}">
                            @error('alamat')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="telepon" class="form-label">Nomor Telepon</label>
                            <input type="text" name="telepon" id="telepon" class="form-control"
                                value="{{ old('telepon', Auth::user()->no_telepon) }}">
                            @error('telepon')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Provinsi / Kota / Kecamatan -->
                        <div class="mb-3">
                            <label for="province" class="form-label">Provinsi</label>
                            <select id="province" name="province_id" class="form-select">
                                <option value="">-- Pilih Provinsi --</option>
                                @foreach ($provinces as $province)
                                    <option value="{{ $province['id'] }}"
                                        {{ old('province_id') == $province['id'] ? 'selected' : '' }}>
                                        {{ $province['name'] }}</option>
                                @endforeach
                            </select>
                            @error('province_id')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="city" class="form-label">Kota / Kabupaten</label>
                            <select id="city" name="city_id" class="form-select" disabled>
                                <option value="">-- Pilih Kota / Kabupaten --</option>
                            </select>
                            @error('city_id')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="district" class="form-label">Kecamatan</label>
                            <select id="district" name="district_id" class="form-select" disabled>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                            @error('district_id')
                                <div class="text-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Kurir & Berat -->
                        <div class="mb-3">
                            <label class="form-label">Pilih Kurir</label>
                            <select name="courier" id="courier" class="form-select" required>
                                <option value="">-- Pilih Kurir --</option>
                                @foreach ($couriers as $key => $label)
                                    <option value="{{ $key }}" {{ old('courier') == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('courier')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>



                        <div class="mb-3">
                            <label for="weight" class="form-label">Total Berat Produk (gram)</label>
                            <input type="number" name="weight" id="weight" class="form-control"
                                value="{{ $totalBerat ?? 0 }}" readonly>
                        </div>


                        <div class="d-flex justify-content-center mb-4 flex-col items-center">
                            <button type="button" id="btn-check-ongkir" class="btn btn-warning px-6 py-3">
                                Hitung Ongkos Kirim
                            </button>
                            <div class="loader mt-4" id="loading-indicator" style="display:none"></div>
                        </div>

                        <div class="mt-4 p-4 bg-indigo-50 border border-indigo-200 rounded-lg results-container"
                            style="display:none">
                            <h2 class="text-xl font-semibold text-indigo-800 mb-4 text-center">
                                Hasil Perhitungan Ongkos Kirim
                            </h2>
                            <div class="space-y-3" id="results-ongkir"></div>
                        </div>
                    </div>
                </div>

                <!-- RINGKASAN -->
                <div class="col-lg-5">
                    <div class="card card-custom p-4 summary-box">
                        <h5 class="fw-bold mb-4">Pesanan Anda</h5>

                        @foreach ($keranjangs as $item)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="label text-truncate" style="max-width: 200px;"
                                    title="{{ $item->produk->nama_produk }}">
                                    {{ $item->produk->nama_produk }} × {{ $item->jumlah }}
                                </span>
                                <span class="value">Rp{{ number_format($item->totalharga, 0, ',', '.') }}</span>
                            </div>
                        @endforeach

                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="label">Subtotal</span>
                            <span class="value">Rp{{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="label">Ongkos Kirim</span>
                            <span class="value text-primary" id="ongkir-text">Rp0</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <strong>Total</strong>
                            <strong class="text-primary fs-5"
                                id="total-text">Rp{{ number_format($total, 0, ',', '.') }}</strong>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2">Konfirmasi Pesanan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Format mata uang IDR
            function formatCurrency(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0
                }).format(amount);
            }

            // Province -> City
            $('select[name="province_id"]').on('change', function() {
                let provinceId = $(this).val();
                let $city = $('select[name="city_id"]');
                let $district = $('select[name="district_id"]');

                $city.empty().append(`<option value="">-- Pilih Kota / Kabupaten --</option>`);
                $district.empty().append(`<option value="">-- Pilih Kecamatan --</option>`);

                if (provinceId) {
                    $.get(`/cekout/cities/${provinceId}`, function(response) {
                        $.each(response, function(index, value) {
                            $city.append(
                                `<option value="${value.id}">${value.name}</option>`);
                        });
                        $city.prop('disabled', false);
                    });
                }
            });

            // City -> District
            $('select[name="city_id"]').on('change', function() {
                let cityId = $(this).val();
                let $district = $('select[name="district_id"]');

                $district.empty().append(`<option value="">-- Pilih Kecamatan --</option>`);

                if (cityId) {
                    $.get(`/cekout/districts/${cityId}`, function(response) {
                        $.each(response, function(index, value) {
                            $district.append(
                                `<option value="${value.id}">${value.name}</option>`);
                        });
                        $district.prop('disabled', false);
                    });
                }
            });

            // Hitung ongkir
            let isProcessing = false;

            $('#btn-check-ongkir').click(function(e) {
                e.preventDefault();
                if (isProcessing) return;

                let token = $("meta[name='csrf-token']").attr("content");
                let origin_id = 4029; // id kecamatan asal (sesuaikan)
                let destination_id = $('select[name=district_id]').val();
                let courier = $('select[name=courier]').val();
                let weight = $('#weight').val();

                if (!destination_id || !courier || !weight) {
                    alert('Harap lengkapi semua data terlebih dahulu!');
                    return;
                }

                isProcessing = true;
                $('#loading-indicator').show();
                $('#btn-check-ongkir').prop('disabled', true).text('Memproses...');

                $.ajax({
                    url: "/cekout/check-ongkir",
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        _token: token,
                        origin_id: origin_id,
                        destination_id: destination_id,
                        courier: courier,
                        weight: weight,
                    },
                    beforeSend: function() {
                        $('.results-container').hide();
                    },
                    success: function(response) {
                        $('#results-ongkir').empty();

                        if (response.status && response.data.length > 0) {
                            $('.results-container').show();

                            let ongkirTotal = response.data[0].cost;

                            $.each(response.data, function(index, value) {
                                $('#results-ongkir').append(`
                                    <div class="flex justify-between items-center p-3 bg-white rounded-xl shadow border border-gray-200">
                                        <span class="text-lg font-medium text-gray-800">${value.service} - ${value.description} (${value.etd})</span>
                                        <span class="text-lg font-bold text-indigo-700">${formatCurrency(value.cost)}</span>
                                    </div>
                                `);
                            });

                            $('#ongkir-text').text(formatCurrency(ongkirTotal));
                            let subtotal = {{ $total }};
                            $('#total-text').text(formatCurrency(subtotal + ongkirTotal));
                            $('#ongkir').val(ongkirTotal);
                        } else {
                            alert(response.message || 'Tidak ada ongkir tersedia');
                        }
                    },
                    error: function(xhr) {
                        console.error("Gagal menghitung ongkir:", xhr.responseText);
                        alert(xhr.responseJSON?.error ||
                            'Terjadi kesalahan saat menghitung ongkir.');
                    },
                    complete: function() {
                        $('#loading-indicator').hide();
                        $('#btn-check-ongkir').prop('disabled', false).text(
                            'Hitung Ongkos Kirim');
                        isProcessing = false;
                    }
                });
            });
        });
    </script>
@endsection
