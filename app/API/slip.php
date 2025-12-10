<?php

namespace App\API;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Response;

class slip extends Model
{

	public function getSiteByNik($nik)
	{
		$user = DB::select(DB::raw("SELECT lokasi_kerja as site from kry_h where nik = '$nik'"));
		return $user->site;
	}

	public function getPeriodeList()
    {
				// $date = "IN(";
				// if(date("m") == "01"){
				// 	$date .= date("Ym",mktime(0, 0, 0, 12,0, date("Y")-1));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, date("m"),0, date("Y")));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, date("m")+1,0, date("Y")));
				// }else if(date("m") == "12"){
				// 	$date .= date("Ym",mktime(0, 0, 0, date("m")-1,0, date("Y")));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, date("m"),0, date("Y")));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, 1,0, date("Y")-1));
				// }else{
				// 	$date .= date("Ym",mktime(0, 0, 0, date("m")-1,0, date("Y")));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, date("m"),0, date("Y")));
				// 	$date .= ",".date("Ym",mktime(0, 0, 0, date("m")+1,0, date("Y")));
				// }

				// // date('Y-m-d H:i:s', strtotime('+1 day', date("m")));

				// if(date("d") > 20){
				// 	$date .= ",".(date("Y"))."".date('m', strtotime('+1 month', date("m")));;
				// }

				// $date .= ")";
				//$date = " LIKE '%2020%' or th_bln LIKE '%2019%'";
				$date = Date("Y");$date2 = Date("Y")-1;
				$peripde = DB::select(DB::raw("select th_bln
				from addroo_hit_gaji
				where th_bln LIKE '%$date%' || th_bln LIKE '%$date2%'
				group by th_bln
				order by th_bln desc"));

        return $peripde;
    }
	
	public function getCustByNik($nik)
	{
		$user = DB::select(DB::raw("SELECT a.nm_customer as cust
				from customer  as a
				left join kry_h as b ON b.kode_karyawan = a.kode_karyawan 
				where c.nik = '$nik'"));
		return $user->cust;
		
	}

	public function getListSlip($nik){
		
	}

	public function getSlipWithLink($periode,$nik,$link)
	{
		$kry = DB::select(DB::raw("SELECT nik from addroo_hit_gaji where nik = '$nik' && th_bln = '$periode'"));
		$link = $link."penggajian_nota.php?page=".base64_encode(base64_encode("Nik=$nik&per=$periode"))."&l=0";
		if(count($kry) == 0) {
			$link = "";
		}
		// $this->getDownload($link);
		return $link;
		
	}

	public function getDownload($link)
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= $link;
				//dd($link);
        $headers = array(
                'Content-Type: application/pdf',
                );

        return Response::download('/foto_karyawan/filename.pdf', $link, $headers);
    }
	
	public function getSlip($periode,$nik)
	{
		$periode = ($periode != "") ? "AND a.th_bln='$periode'":'';
		$slip = DB::select(DB::raw("SELECT 
				IFNULL(IF(x.nik = 'SUBTOTAL','-',@row_num:=@row_num+1),'-')AS nomor,
				IF(x.nik = 'SUBTOTAL','',period)AS period,
				IF(x.nik = 'SUBTOTAL','SUBTOTAL',area)AS area,
				IF(x.nik = 'SUBTOTAL','',cost_center)AS cost_center,
				IF(x.nik = 'SUBTOTAL','',nik)AS nik,
				IF(x.nik = 'SUBTOTAL','',nm_kry)AS nm_kry,
				IF(x.nik = 'SUBTOTAL','',nm_jabatan)AS nm_jabatan,
				IF(x.nik = 'SUBTOTAL','',grade)AS grade,
				IF(x.nik = 'SUBTOTAL','',joindate)AS joindate,
				IF(x.nik = 'SUBTOTAL','',resigndate)AS resigndate,
				IF(x.nik = 'SUBTOTAL','',no_rekening)AS no_rekening
				,x.basic_salary, x.bsbyhk, x.management_allowance, x.management_allowance_grade, x.acting_allowance, x.commnc_allowance, x.transport_allowance, x.meal_allowance, x.administration, x.over_time, x.thr, x.pph21_inc, x.oth_adj_val,
				x.jkk_inc, x.jht_inc, x.jkm_inc, x.tot_jkm, x.jp_inc, x.bpjs_kes_inc, x.jumlah_bruto, x.total_income, x.jkk_ded, x.jkm_ded, x.jht_ded, x.jp_ded, x.bpjs_kes_ded, x.jkk_ded_com, x.jkm_ded_com, x.jht_ded_com, x.jp_ded_com, x.bpjs_kes_ded_com, x.pot_absen, x.pph21_ded, x.LOP, 
				x.COP, x.LOAN, x.oth_adj_val_ded, x.total_deduction, x.net_thp, x.absen_quota, x.balance, x.izin, x.skd, x.cuti, x.sakit, x.alfa,
				x.izin+x.sakit+x.alfa as ttl FROM (
				SELECT a.th_bln as period,(SELECT o.nm_pma FROM pma o WHERE o.kd_pma = b.lokasi_kerja) as area, p.nm_departement_ina as cost_center, COALESCE(a.nik,'SUBTOTAL') as nik, a.nm_kry, q.nm_jabatan, 
				c.grade, c.tanggal_masuk_kerja as joindate,									
				IF(c.tanggal_terminasi = '1970-01-01','-',IF(ISNULL(c.tanggal_terminasi),'-',c.tanggal_terminasi)) as resigndate,
				b.no_rekening,														
				SUM(a.gj_pkk) as basic_salary,
				SUM(a.gp_by_hk) as bsbyhk,													
				SUM(IFNULL(a.tunj_jab,0)) as management_allowance,
				SUM(IFNULL(a.tunj_gol,0)) as management_allowance_grade,													
				SUM(IFNULL(a.tunj_koms,0)) as commnc_allowance,														
				SUM(IFNULL(a.tunj_transp,0)) as transport_allowance,														
				SUM(IFNULL(a.tunj_makan,0)) as meal_allowance,														
				SUM(IFNULL(a.tunj_act,0)) as acting_allowance,														
				SUM(IFNULL(a.tunj_adm,0)) as administration,														
				SUM(a.tot_lembur) as over_time,														
				SUM(a.tot_thr) as thr,														
				SUM(IFNULL(a.pph21perblngu,0)) as pph21_inc,														
				SUM(IFNULL(CASE WHEN j.adj_tp = '-' THEN 0 ELSE j.adj_val END,0)) as oth_adj_val,														
				SUM(a.jkk) as jkk_inc,														
				SUM(a.jkm) as jkm_inc,														
				SUM(a.jht) as jht_inc,
				SUM(a.jkk+a.jkm) as tot_jkm,														
				SUM(a.jp_inc) as jp_inc,														
				SUM(a.bpjs_kes) as bpjs_kes_inc,

				SUM(IFNULL(a.gp_by_hk,0)+IFNULL(a.tunj_gol,0)+IFNULL(a.tunj_jab,0)+IFNULL(a.tunj_act,0)+IFNULL(a.tunj_koms,0)+IFNULL(a.tunj_makan,0)+
				IFNULL(a.tunj_transp,0)+IFNULL(CASE WHEN j.adj_tp = '-' THEN 0 ELSE j.adj_val END,0)+IFNULL(a.tot_lembur,0)+IFNULL(a.tot_thr,0)-IFNULL(a.pot_absen,0)) as jumlah_bruto,

				SUM(IFNULL(a.gp_by_hk,0)+IFNULL(a.tunj_gol,0)+IFNULL(a.tunj_jab,0)+IFNULL(a.tunj_koms,0)+IFNULL(a.tunj_transp,0)+IFNULL(a.tunj_makan,0)+
				IFNULL(a.tunj_act,0)+IFNULL(a.tunj_adm,0)+IFNULL(a.tot_lembur,0)+IFNULL(a.tot_thr,0)+IFNULL(a.pph21perblngu,0)+
				IFNULL(a.jkk,0)+IFNULL(a.jkm,0)+IFNULL(a.jht,0)+IFNULL(a.jp_inc,0)+IFNULL(a.bpjs_kes,0)+														
				IFNULL((CASE WHEN j.adj_tp = '-' THEN 0 ELSE j.adj_val END),0)) as total_income,														
																		
				SUM(a.jkk_ded) as jkk_ded,														
				SUM(a.jkm_ded) as jkm_ded,														
				SUM(a.jht_ded) as jht_ded,														
				SUM(a.jp) as jp_ded,														
				SUM(a.bpjs_kes_deduction) as bpjs_kes_ded,														
				SUM(a.jkk) as jkk_ded_com,														
				SUM(a.jkm) as jkm_ded_com,														
				SUM(a.jht) as jht_ded_com,														
				SUM(a.jp_inc) as jp_ded_com,														
				SUM(a.bpjs_kes) as bpjs_kes_ded_com,														
				SUM(a.pot_absen) as pot_absen,

				SUM(a.pph21perblngu) as pph21_ded,

				SUM(IFNULL(l.nilai_cicil,0)) as LOP,														
				SUM(IFNULL(m.nilai_cicil,0)+ IFNULL(CASE WHEN j.adj_tp = '+' THEN 0 ELSE j.adj_val END,0)) as COP,														
				SUM(IFNULL(n.nilai_cicil,0)) as LOAN,														
				SUM(IFNULL(CASE WHEN j.adj_tp = '+' THEN 0 ELSE j.adj_val END,0)) as oth_adj_val_ded,

				SUM(IFNULL(a.jkk,0)+IFNULL(a.jkm,0)+IFNULL(a.jht,0)+IFNULL(a.jht_ded,0)+IFNULL(a.jp_inc,0)+
				IFNULL(a.jp,0)+IFNULL(a.bpjs_kes,0)+IFNULL(a.bpjs_kes_deduction,0)+IFNULL(a.pot_absen,0)+
				IFNULL(a.pph21perblngu,0)+IFNULL(l.nilai_cicil,0)+														
				IFNULL(m.nilai_cicil,0)+IFNULL(n.nilai_cicil,0)+IFNULL((CASE WHEN j.adj_tp = '+' THEN 0 ELSE j.adj_val END),0)) as total_deduction,

				SUM((														
				IFNULL(a.gp_by_hk,0)+IFNULL(a.tunj_gol,0)+IFNULL(a.tunj_jab,0)+IFNULL(a.tunj_koms,0)+IFNULL(a.tunj_transp,0)+
				IFNULL(a.tunj_makan,0)+IFNULL(a.tunj_act,0)+IFNULL(a.tunj_adm,0)+IFNULL(a.tot_lembur,0)+
				IFNULL(a.tot_thr,0)+IFNULL(a.pph21perblngu,0)+IFNULL(a.jkk,0)+IFNULL(a.jkm,0)+IFNULL(a.jht,0)+
				IFNULL(a.jp_inc,0)+IFNULL(a.bpjs_kes,0)+IFNULL((CASE WHEN j.adj_tp = '-' THEN 0 ELSE j.adj_val END),0)						
				)-														
				(														
				IFNULL(a.jkk,0)+IFNULL(a.jkm,0)+IFNULL(a.jht,0)+IFNULL(a.jht_ded,0)+IFNULL(a.jp_inc,0)+
				IFNULL(a.jp,0)+IFNULL(a.bpjs_kes,0)+IFNULL(a.bpjs_kes_deduction,0)+IFNULL(a.pot_absen,0)+
				IFNULL(a.pph21perblngu,0)+IFNULL(l.nilai_cicil,0)+														
				IFNULL(m.nilai_cicil,0)+IFNULL(n.nilai_cicil,0)+														
				IFNULL((CASE WHEN j.adj_tp = '+' THEN 0 ELSE j.adj_val END),0)														
				)) as net_thp,

				SUM(a.hk) as absen_quota,a.hke as balance,
				SUM((SELECT DISTINCT IF(z.tipe_krj='IZIN',SUM(z.flag_izn),0) FROM absen_det z WHERE z.nik=a.nik AND z.th_bln=a.th_bln AND z.tipe_krj='IZIN')) as izin,
				SUM((SELECT DISTINCT IF(z.tipe_krj='SAKIT',SUM(z.flag_izn),0) FROM absen_det z WHERE z.nik=a.nik AND z.th_bln=a.th_bln AND z.tipe_krj='SAKIT')) as sakit,
				SUM((SELECT DISTINCT IF(z.tipe_krj='SKD',SUM(z.flag_skt),0) FROM absen_det z WHERE z.nik=a.nik AND z.th_bln=a.th_bln AND z.tipe_krj='SKD')) as skd,
				SUM((SELECT DISTINCT IF(z.tipe_krj='CUTI',SUM(z.flag_skt),0) FROM absen_det z WHERE z.nik=a.nik AND z.th_bln=a.th_bln AND z.tipe_krj='CUTI')) as cuti,
				SUM(a.flag_alf) AS alfa															
																		
								FROM										
									addroo_hit_gaji AS a									
								LEFT JOIN kry_h AS b ON a.nik = b.nik										
								LEFT JOIN kry_d1 AS c ON b.kode_karyawan = c.kode_karyawan										
								LEFT JOIN departement AS d ON c.departemen = d.kd_departement										
								LEFT JOIN principle AS e ON d.kd_principle = e.kd_principle										
								LEFT JOIN pma as f ON f.kd_pma = b.lokasi_kerja										
								LEFT JOIN (select nik, adj_periode, adj_status, adj_tp, SUM(adj_val) AS adj_val from adjustment GROUP BY nik, adj_periode WITH ROLLUP) j ON (a.nik = j.nik AND a.th_bln = j.adj_periode AND j.adj_status = 0)										
								LEFT JOIN bpjs as k ON a.kd_customer = k.kd_customer										
																		
								LEFT JOIN (SELECT aa.id_pinj, aa.tipe_pinj, aa.nik, aa.tgl_akad_pinj, aa.pokok_pinj, aa.jangka_pinj, aa.period_angs_pertama,										
															 aa.bunga_pinj, aa.status_pinj, aa.flag_pinj, aa.denda_pinj, aa.`user`, aa.last_upd, ab.tgl_byr_pinj,			
															 ab.cicil_ke, ab.nilai_cicil, ab.sisa_pinj, ab.th_bln			
														FROM pinjaman_h AS aa				
													 LEFT JOIN pinjaman_d AS ab ON aa.id_pinj = ab.id_pinj					
														 WHERE #aa.nik = '20161745' AND ab.th_bln='201702' AND 
																	 aa.tipe_pinj = 'LOP' GROUP BY aa.nik) as l	
												ON a.nik = l.nik AND a.th_bln = l.th_bln						
																		
								LEFT JOIN (SELECT aa.id_pinj, aa.tipe_pinj, aa.nik, aa.tgl_akad_pinj, aa.pokok_pinj, aa.jangka_pinj, aa.period_angs_pertama,										
															 aa.bunga_pinj, aa.status_pinj, aa.flag_pinj, aa.denda_pinj, aa.`user`, aa.last_upd, ab.tgl_byr_pinj,			
															 ab.cicil_ke, ab.nilai_cicil, ab.sisa_pinj, ab.th_bln			
														FROM pinjaman_h AS aa				
													 LEFT JOIN pinjaman_d AS ab ON aa.id_pinj = ab.id_pinj					
														 WHERE #aa.nik = '20161745' AND ab.th_bln='201702' AND 
																	 aa.tipe_pinj = 'COP' GROUP BY aa.nik) as m	
												ON a.nik = m.nik AND a.th_bln = m.th_bln						
																		
								LEFT JOIN (SELECT aa.nik, SUM(ab.nilai_cicil)AS nilai_cicil, ab.th_bln										
														 FROM pinjaman_h AS aa				
														LEFT JOIN pinjaman_d AS ab ON aa.id_pinj = ab.id_pinj				
															WHERE #aa.nik = '20161745' AND ab.th_bln='201702' AND 
															aa.tipe_pinj in ('MOP','SOFT LOAN','OTH') GROUP BY aa.nik) as n
												ON a.nik = n.nik AND a.th_bln = n.th_bln						
																		
								LEFT JOIN (SELECT										
														aa.nik, aa.lokasi_kerja, ab.nm_pma, ab.nm_om FROM kry_h AS aa LEFT JOIN pma AS ab ON aa.lokasi_kerja = ab.kd_pma) as o				
												ON a.nik = o.nik						
																		
								LEFT JOIN departement AS p ON c.departemen = p.kd_departement										
								LEFT JOIN jabatan as q ON c.jabatan = q.kd_jabatan
								WHERE 
								a.nik = '".$nik."' 
								$periode
								 
								GROUP BY p.nm_departement_ina, a.nik) AS x 
						   "));
		
		if(count($slip) == 0) {
			return "";
		}
		return $slip;
	}
	
	

}
