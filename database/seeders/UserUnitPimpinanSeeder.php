<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\UnitModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Artisan;

class UserUnitPimpinanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
		$user_unit = [
			["user" => "Dr. H. Deden Komar Priatna, S.T., SIP., M.M., CHRA", "unit" => "Rektor"],
			["user" => "Prof. Dr. Hj. Ai Komariah, Ir., M.S", "unit" => "Wakil Rektor 1"],
			["user" => "Rudi S. Ahmadi, Drs., M.M", "unit" => "Wakil Rektor 2"],
			["user" => "Dr. Elly Roosma Ria, Ir., M.Si.", "unit" => "Wakil Rektor 3"],
			["user" => "Dr. Dety Sukmawati, Ir., M.P", "unit" => "Dekan Fakultas Pertanian"],
			["user" => "Yuliaty Heliana Pangow, S.T., M.T", "unit" => "Dekan Fakultas Teknik, Perencanaan & Arsitektur"],
			["user" => "Raizal Fami Sholihat, S.Hut., M.P", "unit" => "Dekan Fakultas Kehutanan"],
			["user" => "Dr. Hj. Winna Roswinna, S.E., M.M", "unit" => "Dekan Fakultas Ekonomi dan Bisnis"],
			["user" => "Dr. Nataliningsih, Ir., M.Pd", "unit" => "Ketua SPMI"],
			["user" => "Dr. Syapril Janizar, S.T., M.T", "unit" => "Ketua LPPM"],
			["user" => "Romiyadi, S.P., M.P", "unit" => "Wakil Dekan Fakultas Pertanian"],
			["user" => "Sigit Wisnuadji, S.T., M.Sc", "unit" => "Wakil Dekan Teknik, Perencanaan &Arsitektur"],
			["user" => "Fahriza Luth, S.Hut., M.P", "unit" => "Wakil Dekan Fakultas Kehutanan"],
			["user" => "Maria Lusiana Yulianti, S.E., M.M", "unit" => "Wakil Dekan Fakultas Ekonomi dan Bisnis"],
			["user" => "Yuliana Samantha, S.P., M.EP", "unit" => "Kepala Biro Kemahasiswaan"],
			["user" => "Dr. Ir. An An Anisarida, S.T., M.T", "unit" => "Kepala Biro Kerjasama"],
			["user" => "Sopyan Agus Salam, S.Sos., M.M", "unit" => "Kepala Biro Umum dan Kepegawaian"],
			["user" => "Anne Lasminingrat, S.E., M.M", "unit" => "Kepala Biro Keuangan"],
			["user" => "Roby Ahada, S.Kom., M.M", "unit" => "Sekretaris Rektor"],
			["user" => "Roni Assafaat Hadi, S.P, M.P", "unit" => "Sekretaris LPPM"],
			["user" => "Edang Juliana, S.P., M.P", "unit" => "Sekretaris SPMI"],
			["user" => "Mochamad Maulana, S.T", "unit" => "Kepala Divisi PMB & IT"],
			["user" => "Tuti Anggraeni, S.T., M.M", "unit" => "Kepala Divisi Humas &Protokoler"],
			["user" => "Dr. Hj. Euis Dasipah, Ir., M.P", "unit" => "Kaprodi Magister Agribisnis (S2)"],
			["user" => "Dr.Kovertina Rakhmi Indriana, S.P., M.P", "unit" => "Kaprodi Magister Agroteknologi (S2)"],
			["user" => "Dr. Nendah Siti Permana, Ir., M.P", "unit" => "Kaprodi Agribisnis (S1)"],
			["user" => "Asep Samsul Mustopa, S.P., M.P", "unit" => "Kaprodi Agroteknologi (S1)"],
			["user" => "Edwar Hafudiansyah, S.Pd., M.T", "unit" => "Kaprodi Teknik Sipil"],
			["user" => "Dian Kusbandiah, S.T., M.T", "unit" => "Kaprodi Teknik Arsitektur"],
			["user" => "Levana Apriani, S.T., M.T", "unit" => "Kaprodi Teknik Geodesi"],
			["user" => "Achmad Saeful Fasa, S.T., M.T", "unit" => "Kaprodi Teknik Perencanaan Wilayah & Kota"],
			["user" => "Santi Prihastuti, S.Si., M.T", "unit" => "Kaprodi Teknik Lingkungan"],
			["user" => "Rian Susila, S.Hut., M.P", "unit" => "Kaprodi Ilmu Kehutanan"],
			["user" => "Dr. Annisa Fitri Anggraeni, S.E., M.M", "unit" => "Kaprodi Magister Manajemen (S2)"],
			["user" => "Dodi Tisna Amijaya, S.E., M.M", "unit" => "Kaprodi Manajemen (S1)"],
			["user" => "Kartika Pratiwi Putri, S.E., M.Ak", "unit" => "Kaprodi Akuntansi (S1)"],
			["user" => "Agi Dahtiar, S.Pd., M.Pd., M.P", "unit" => "Kepala Bagian Akademik Fakultas Pertanian"],
			["user" => "Reni Nurhayatini, S.T., M.P", "unit" => "Kepala Bagian Non Akademik Fakultas Pertanian"],
			["user" => "Deni Irawan, S.T", "unit" => "Kepala Bagian Akademik Fakultas Teknik, Perencanaan & Arsitektur"],
			["user" => "Alica Gina Rachmalia Sutanto, S.I.Kom", "unit" => "Kepala Bagian Non Akademik Fakultas Teknik, Perencanaan & Arsitektur"],
			["user" => "Vina Silvia Bintarawati, S.Hut", "unit" => "Kepala Bagian Akademik Fakultas Kehutanan"],
			["user" => "Euis Ernawati, S.Pd", "unit" => "Kepala Bagian Non Akademik Fakultas Kehutanan"],
			["user" => "Heri Lukman, S.E", "unit" => "Kepala Bagian Akademik Fakultas Ekonomi dan Bisnis"],
			["user" => "Hilman Abdurrahman, S.E., M.M", "unit" => "Kepala Bagian Non Akademik Fakultas Ekonomi dan Bisnis"],
			["user" => "Anang Suryana, S.P", "unit" => "Kepala UPT Kebun Produksi"],
			["user" => "Dr. Dodi Sukmayana, S.E., M.M", "unit" => "Dosen Tetap"],
			["user" => "Ir. Yana Taryana, M.P.", "unit" => "Dosen Tetap"],
			["user" => "Ina Revayanti, S.T., M.T", "unit" => "Dosen Tetap"],
			["user" => "Dr. Ir. Sri Wilujeung, M.SI.", "unit" => "Dosen Tetap"],
			["user" => "Ir. Asep Purwanto, MM.", "unit" => "Dosen Tetap"],
			["user" => "Herni Suryani, S.E., S.I.Kom., MM", "unit" => "Dosen Tetap"],
			["user" => "Ripki Ripkianto, S.E", "unit" => "Staf Akademik Fakultas Ekonomi dan Bisnis"]
		];

		$role = Role::where(['name' => 'Pengguna'])->get()->first();
		foreach($user_unit as $i => $u)
		{
			$unit = UnitModel::firstOrCreate(['nama' => $u['unit']]);
			$us = User::firstOrCreate(
				[
					'name' => $u['user']
				],
				[
					'email' => 'pengguna'.$i.'@simpan.local',
					'password' => Hash::make('12345')
				]
			);
			$us->assignRole([$role->id]);
			$us->assignUnit([$unit->id]);
			$us->assignUnitRole([$unit->id],[$role->name]);
		}

    }
}
