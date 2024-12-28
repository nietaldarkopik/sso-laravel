<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		
		$menu = [
			[
				"url" => "/",
				"icon" => "nav-icon fas fa-tachometer-alt",
				"text" => "Dashboard",
			],
			[
				"url" => "#",
				"icon" => "nav-icon fas fa-copy",
				"text" => "Konten Manajemen",
				"submenu" => [
					[
						"route" => "admin.halaman.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Halaman",
					],
					[
						"route" => "admin.menu.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Menu",
					],
					[
						"route" => "admin.faq.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "FAQ",
					],
				],
			],
			[
				"url" => "#",
				"icon" => "nav-icon fas fa-edit",
				"text" => "Data Pengajuan",
				"submenu" => [
					[
						"route" => "admin.pengajuan.create",
						"icon" => "far fa-circle nav-icon",
						"text" => "Buat Pengajuan",
					],
					[
						"route" => "admin.pengajuan.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Tracking Pengajuan",
					],
					[
						"route" => "admin.riwayat.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Riwayat Pengajuan",
					],
					[
						"route" => "admin.laporan.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Laporan",
					],
				],
			],
			[
				"url" => "#",
				"icon" => "nav-icon fas fa-edit",
				"text" => "Data Master",
				"submenu" => [
					[
						"route" => "admin.unit.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Unit",
					],
					[
						"route" => "admin.sop.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "SOP",
					],
				],
			],
			[
				"url" => "#",
				"icon" => "nav-icon fas fa-edit",
				"text" => "Pengguna",
				"submenu" => [
					[
						"route" => "admin.roles.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Hak Akses",
					],
					[
						"route" => "admin.users.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Pengguna",
					],
					[
						"route" => "admin.ubah-password.index",
						"icon" => "far fa-circle nav-icon",
						"text" => "Ubah Password",
					],
				],
			],

		];

		foreach($menu as $i => $m)
		{
			$parent = DB::table('menus')->insertGetId([
				'menu_group_id' => 1,
				'parent_id' => 0,
				'route' => $m['route'] ?? '',
				'url' => $m['url'] ?? '#',
				'title' => $m['text'] ?? 'Untitled '.$i,
				'sort_order' => $i,
				'icon' => $m['icon'] ?? 'far fa-circle nav-icon '
			]);

			$submenu = (isset($m['submenu']))?$m['submenu']:[];
			foreach($submenu as $i2 => $m2)
			{
					
				$parent = DB::table('menus')->insert([
					'menu_group_id' => 1,
					'parent_id' => $parent,
					'route' => $m2['route'] ?? '',
					'url' => $m2['url'] ?? '#',
					'title' => $m2['text'] ?? 'Untitled '.$i,
					'sort_order' => $i,
					'icon' => $m2['icon'] ?? 'far fa-circle nav-icon '
				]);
			}
		}
        return view('home');
    }
}
