<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class RajaOngkirController
{
    /**
     * Menampilkan halaman awal dengan daftar provinsi
     */
    public function index()
    {
        $provinces = [];

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'key'    => config('rajaongkir.api_key'),
            ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

            if ($response->successful()) {
                $provinces = $response->json()['data'] ?? [];
            }
        } catch (\Exception $e) {
            \Log::error('RajaOngkir province error: ' . $e->getMessage());
        }

        return view('user.rajaongkir.index', compact('provinces'));
    }

    /**
     * Mengambil data kota berdasarkan ID provinsi
     */
    public function getCities($provinceId): JsonResponse
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'key'    => config('rajaongkir.api_key'),
            ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

            if ($response->successful()) {
                return response()->json([
                    'status' => true,
                    'data'   => $response->json()['data'] ?? [],
                ]);
            }

            return response()->json(['status' => false, 'data' => []], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat mengambil data kota',
            ], 500);
        }
    }

    /**
     * Mengambil data kecamatan berdasarkan ID kota
     */
    public function getDistricts($cityId): JsonResponse
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'key'    => config('rajaongkir.api_key'),
            ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

            if ($response->successful()) {
                return response()->json([
                    'status' => true,
                    'data'   => $response->json()['data'] ?? [],
                ]);
            }

            return response()->json(['status' => false, 'data' => []], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat mengambil data kecamatan',
            ], 500);
        }
    }

    /**
     * Menghitung ongkos kirim
     */
    public function checkOngkir(Request $request): JsonResponse
    {
        $request->validate([
            'district_id' => 'required|integer',
            'weight'      => 'required|integer|min:1',
            'courier'     => 'required|string',
        ]);

        try {
            $response = Http::asForm()->withHeaders([
                'Accept' => 'application/json',
                'key'    => config('rajaongkir.api_key'),
            ])->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin'      => config('rajaongkir.origin', 3855), // bisa diatur di config/rajaongkir.php
                'destination' => $request->district_id,
                'weight'      => $request->weight,
                'courier'     => $request->courier,
            ]);

            if ($response->successful()) {
                return response()->json([
                    'status' => true,
                    'data'   => $response->json()['data'] ?? [],
                ]);
            }

            return response()->json(['status' => false, 'data' => []], 400);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat menghitung ongkos kirim',
            ], 500);
        }
    }
}
