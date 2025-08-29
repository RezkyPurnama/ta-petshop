<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Raja Ongkir V2 - SantriKoding.com</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <style>
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4f46e5;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
            margin: 0 auto;
            display: none
        }
        @keyframes spin {
            0% { transform: rotate(0deg) }
            100% { transform: rotate(360deg) }
        }
    </style>
</head>
<body class="bg-gray-200 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white p-8 rounded-xl shadow w-full max-w-2xl">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Kalkulator Ongkos Kirim (V2)</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <!-- Dropdown Provinsi -->
            <div>
                <label for="province" class="block text-sm font-medium text-gray-700 mb-1">Provinsi Tujuan</label>
                <select id="province" name="province_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow">
                    <option value="">-- Pilih Provinsi --</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province['id'] }}">{{ $province['name'] }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Dropdown Kota / Kabupaten -->
            <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">Kota / Kabupaten Tujuan</label>
                <select id="city" name="city_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed">
                    <option value="">-- Pilih Kota / Kabupaten --</option>
                </select>
            </div>

            <!-- Dropdown Kecamatan -->
            <div>
                <label for="district" class="block text-sm font-medium text-gray-700 mb-1">Kecamatan Tujuan</label>
                <select id="district" name="district_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow-sm disabled:bg-gray-50 disabled:cursor-not-allowed">
                    <option value="">-- Pilih Kecamatan --</option>
                </select>
            </div>

            <!-- Input Berat -->
            <div>
                <label for="weight" class="block text-sm font-medium text-gray-700 mb-1">Berat Barang (gram)</label>
                <input type="number" name="weight" id="weight" min="1000" placeholder="Masukkan berat barang dalam gram" class="mt-1 block w-full pl-3 pr-3 py-2 text-base bg-gray-200 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md shadow">
            </div>

        </div>

        <!-- Radio Box Kurir -->
        <div class="mb-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kurir</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @php
                    $couriers = [
                        'sicepat' => 'SICEPAT',
                        'jnt' => 'J&T',
                        'ninja' => 'Ninja Express',
                        'jne' => 'JNE',
                        'anteraja' => 'Anteraja',
                        'pos' => 'POS Indonesia',
                        'tiki' => 'Tiki',
                        'wahana' => 'Wahana',
                        'lion' => 'Lion Parcel',
                    ];
                @endphp
                @foreach($couriers as $value => $label)
                    <div class="flex items-center">
                        <input type="radio" name="courier" id="courier-{{ $value }}" value="{{ $value }}" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                        <label for="courier-{{ $value }}" class="ml-2 block text-sm text-gray-900">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Tombol hitung -->
        <div class="flex justify-center mb-8 flex-col items-center">
            <button class="btn-check w-full md:w-auto px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50 disabled:cursor-not-allowed">
                Hitung Ongkos Kirim
            </button>
            <div class="loader mt-4" id="loading-indicator"></div>
        </div>

        <!-- Hasil Ongkir -->
        <div class="mt-8 p-6 bg-indigo-50 border border-indigo-200 rounded-lg results-container hidden">
            <h2 class="text-xl font-semibold text-indigo-800 mb-4 text-center">Hasil Perhitungan Ongkos Kirim</h2>
            <div class="space-y-3" id="results-ongkir"></div>
        </div>

        <script>
            $(document).ready(function() {

                function formatCurrency(amount) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    }).format(amount);
                }

                // Dropdown Kota
                $('select[name="province_id"]').on('change', function() {
                    let provinceId = $(this).val();
                    if (provinceId) {
                        $.ajax({
                            url: `/rajaongkir/cities/${provinceId}`,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="city_id"]').empty().append(`<option value="">-- Pilih Kota / Kabupaten --</option>`);
                                if (response.status && response.data) {
                                    $.each(response.data, function(index, value) {
                                        $('select[name="city_id"]').append(`<option value="${value.id}">${value.name}</option>`);
                                    });
                                }
                            }
                        });
                    } else {
                        $('select[name="city_id"]').empty().append(`<option value="">-- Pilih Kota / Kabupaten --</option>`);
                    }
                });

                // Dropdown Kecamatan
                $('select[name="city_id"]').on('change', function() {
                    let cityId = $(this).val();
                    if (cityId) {
                        $.ajax({
                            url: `/rajaongkir/districts/${cityId}`,
                            type: "GET",
                            dataType: "json",
                            success: function(response) {
                                $('select[name="district_id"]').empty().append(`<option value="">-- Pilih Kecamatan --</option>`);
                                if (response.status && response.data) {
                                    $.each(response.data, function(index, value) {
                                        $('select[name="district_id"]').append(`<option value="${value.id}">${value.name}</option>`);
                                    });
                                }
                            }
                        });
                    } else {
                        $('select[name="district_id"]').empty().append(`<option value="">-- Pilih Kecamatan --</option>`);
                    }
                });

                // Ajax cek ongkir
                let isProcessing = false;
                $('.btn-check').click(function (e) {
                    e.preventDefault();
                    if (isProcessing) return;

                    let token       = $("meta[name='csrf-token']").attr("content");
                    let district_id = $('select[name=district_id]').val();
                    let courier     = $('input[name=courier]:checked').val();
                    let weight      = $('#weight').val();

                    if (!district_id || !courier || !weight) {
                        alert('Harap lengkapi semua data terlebih dahulu!');
                        return;
                    }

                    isProcessing = true;
                    $('#loading-indicator').show();
                    $('.btn-check').prop('disabled', true).text('Memproses...');

                    $.ajax({
                        url: "/rajaongkir/check-ongkir",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            _token: token,
                            district_id: district_id,
                            courier: courier,
                            weight: weight,
                        },
                        beforeSend: function() {
                            $('.results-container').addClass('hidden').removeClass('block');
                        },
                        success: function (response) {
                            $('#results-ongkir').empty();
                            if (response.status && response.data) {
                                $('.results-container').removeClass('hidden').addClass('block');
                                $.each(response.data, function (index, value) {
                                    $('#results-ongkir').append(`
                                        <div class="flex justify-between items-center p-3 bg-white rounded-xl shadow border border-gray-200">
                                            <span class="text-lg font-medium text-gray-800">
                                                ${value.service} - ${value.description} - (${value.etd})
                                            </span>
                                            <span class="text-lg font-bold text-indigo-700">
                                                ${formatCurrency(value.cost)}
                                            </span>
                                        </div>
                                    `);
                                });
                            } else {
                                alert("Tidak ada data ongkir tersedia.");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("Gagal menghitung ongkir:", error);
                            alert("Terjadi kesalahan saat menghitung ongkir. Coba lagi.");
                        },
                        complete: function () {
                            $('#loading-indicator').hide();
                            $('.btn-check').prop('disabled', false).text('Hitung Ongkos Kirim');
                            isProcessing = false;
                        }
                    });
                });
            });
        </script>
    </div>
</body>
</html>
