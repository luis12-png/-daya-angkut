<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daya Angkut</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 30px;
        }
        .custom-table {
            border: 2px solid #007bff; /* Border tabel dengan warna primer Bootstrap */
        }
        .custom-table th, .custom-table td {
            border: 1px solid #007bff; /* Border sel tabel dengan warna primer Bootstrap */
        }
        .form-section {
            background-color: #f8f9fa; /* Warna latar belakang untuk form */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .result-table {
            margin-top: 20px;
            background-color: #e9ecef; /* Warna latar belakang untuk tabel hasil */
        }
        .btn-custom {
            margin: 0 5px; /* Spasi antar tombol */
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center mb-4">DAYA ANGKUT BUS</h2>

        <div class="form-section">
            <form method="post" action="" class="mt-4">
                <table class="table table-bordered custom-table">
                    <tbody>
                        <tr>
                            <td><label for="berat_penumpang" class="form-label">Berat Penumpang (kg):</label></td>
                            <td><input type="number" class="form-control" name="berat_penumpang" id="berat_penumpang" required></td>
                        </tr>
                        <tr>
                            <td><label for="jumlah_penumpang" class="form-label">Jumlah Penumpang:</label></td>
                            <td><input type="number" class="form-control" name="jumlah_penumpang" id="jumlah_penumpang" required></td>
                        </tr>
                        <tr>
                            <td><label for="berat_barang" class="form-label">Berat Barang (kg):</label></td>
                            <td><input type="number" class="form-control" name="berat_barang" id="berat_barang" required></td>
                        </tr>
                        <tr>
                            <td><label for="S1" class="form-label">Nilai S1:</label></td>
                            <td><input type="number" class="form-control" name="S1" id="S1" required></td>
                        </tr>
                        <tr>
                            <td><label for="S2" class="form-label">Nilai S2:</label></td>
                            <td><input type="number" class="form-control" name="S2" id="S2" required></td>
                        </tr>
                        <tr>
                            <td><label for="a" class="form-label">Nilai a:</label></td>
                            <td><input type="number" class="form-control" name="a" id="a" required></td>
                        </tr>
                        <tr>
                            <td><label for="q" class="form-label">Nilai q:</label></td>
                            <td><input type="number" class="form-control" name="q" id="q" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">
                                <button type="submit" name="hitung" class="btn btn-primary btn-custom">Hitung</button>
                                <button type="button" id="clear" class="btn btn-secondary btn-custom">Clear</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <?php
        if (isset($_POST['hitung'])) {
            // Pastikan variabel POST diisi
            $berat_penumpang = isset($_POST['berat_penumpang']) ? $_POST['berat_penumpang'] : 0;
            $jumlah_penumpang = isset($_POST['jumlah_penumpang']) ? $_POST['jumlah_penumpang'] : 0;
            $berat_barang = isset($_POST['berat_barang']) ? $_POST['berat_barang'] : 0;
            $S1 = isset($_POST['S1']) ? $_POST['S1'] : 0;
            $S2 = isset($_POST['S2']) ? $_POST['S2'] : 0;
            $a = isset($_POST['a']) ? $_POST['a'] : 0;
            $q = isset($_POST['q']) ? $_POST['q'] : 0;

            // Perhitungan L: (Berat Penumpang * Jumlah Penumpang) - Berat Barang
            $hasil_L = ($berat_penumpang * $jumlah_penumpang) - $berat_barang;

            // Perhitungan JBI tetap: L + S1 + S2
            $hasil_JBI = $hasil_L + $S1 + $S2;

            // Pengecekan untuk menghindari pembagian dengan nol
            if ($a != 0) {
                // Perhitungan R1: S1 + (L * ((a - q) / a))
                $hasil_R1 = $S1 + ($hasil_L * (($a - $q) / $a));
                
                // Perhitungan R2: S2 + (L * (q / a))
                $hasil_R2 = $S2 + ($hasil_L * ($q / $a));
            } else {
                $hasil_R1 = "Tidak dapat dihitung (a tidak boleh nol)";
                $hasil_R2 = "Tidak dapat dihitung (a tidak boleh nol)";
            }

            // Perhitungan FOH: 47.5% x a
            $hasil_FOH = 0.475 * $a;

            // Perhitungan ROH: 62.5% x a
            $hasil_ROH = 0.625 * $a;

            echo "
            <div class='result-table'>
            <table class='table table-bordered custom-table mt-4'>
                <thead>
                    <tr>
                        <th>Parameter</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Berat Penumpang (kg)</td>
                        <td>$berat_penumpang</td>
                    </tr>
                    <tr>
                        <td>Jumlah Penumpang</td>
                        <td>$jumlah_penumpang</td>
                    </tr>
                    <tr>
                        <td>Berat Barang (kg)</td>
                        <td>$berat_barang</td>
                    </tr>
                    <tr>
                        <td>Nilai S1</td>
                        <td>$S1</td>
                    </tr>
                    <tr>
                        <td>Nilai S2</td>
                        <td>$S2</td>
                    </tr>
                    <tr>
                        <td>Nilai a</td>
                        <td>$a</td>
                    </tr>
                    <tr>
                        <td>Nilai q</td>
                        <td>$q</td>
                    </tr>
                    <tr>
                        <td>Hasil (L) (kg)</td>
                        <td>$hasil_L</td>
                    </tr>
                    <tr>
                        <td>Hasil (JBI) (kg)</td>
                        <td>$hasil_JBI</td>
                    </tr>
                    <tr>
                        <td>Hasil (R1)</td>
                        <td>$hasil_R1</td>
                    </tr>
                    <tr>
                        <td>Hasil (R2)</td>
                        <td>$hasil_R2</td>
                    </tr>
                    <tr>
                        <td>Hasil (FOH)</td>
                        <td>$hasil_FOH</td>
                    </tr>
                    <tr>
                        <td>Hasil (ROH)</td>
                        <td>$hasil_ROH</td>
                    </tr>
                </tbody>
            </table>
            </div>";
        }
        ?>

    </div>

    <!-- Bootstrap JS (optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JavaScript for clearing the form and results -->
    <script>
        document.getElementById('clear').addEventListener('click', function() {
            // Reset form inputs
            document.querySelector('form').reset();

            // Clear results
            const resultTables = document.querySelectorAll('.result-table');
            resultTables.forEach(table => table.remove());
        });
    </script>

</body>
</html>
