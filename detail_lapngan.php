<?php
include 'koneksi.php';
$id_lapangan = $_GET['id'];

// Ambil data jadwal berdasarkan lapangan yang dipilih
$query_jadwal = "SELECT * FROM jadwal WHERE id_lapangan = '$id_lapangan' AND status_jadwal = 'Tersedia'";
$result = mysqli_query($conn, $query_jadwal);
?>

<table>
    <tr>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Aksi</th>
    </tr>
    <?php while($jadwal = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $jadwal['tanggal']; ?></td>
        <td><?php echo $jadwal['jam_mulai']; ?></td>
        <td><?php echo $jadwal['jam_selesai']; ?></td>
        <td><a href="proses_booking.php?id_jadwal=<?php echo $jadwal['id_jadwal']; ?>">Booking</a></td>
    </tr>
    <?php } ?>
</table>