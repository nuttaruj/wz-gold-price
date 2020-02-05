<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://walnutztudio.com
 * @since      1.0.0
 *
 * @package    Wz_gold_price
 * @subpackage Wz_gold_price/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wz_gold_price
 * @subpackage Wz_gold_price/admin
 * @author     WalnutZtudio <walnutztudio@gmail.com>
 */
class Wz_gold_price_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wz_gold_price_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wz_gold_price_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wz_gold_price-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wz_gold_price_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wz_gold_price_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wz_gold_price-admin.js', array( 'jquery' ), $this->version, false );

	}

}


function wz_gold_price_api( $atts ){
	ob_start();
	$thai_day_arr = array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
	$thai_month_arr = array(
		"0"=>"",
		"1"=>"มกราคม",
		"2"=>"กุมภาพันธ์",
		"3"=>"มีนาคม",
		"4"=>"เมษายน",
		"5"=>"พฤษภาคม",
		"6"=>"มิถุนายน",
		"7"=>"กรกฎาคม",
		"8"=>"สิงหาคม",
		"9"=>"กันยายน",
		"10"=>"ตุลาคม",
		"11"=>"พฤศจิกายน",
		"12"=>"ธันวาคม"
	);
	$thai_month_arr_short=array(
		"0"=>"",
		"1"=>"ม.ค.",
		"2"=>"ก.พ.",
		"3"=>"มี.ค.",
		"4"=>"เม.ย.",
		"5"=>"พ.ค.",
		"6"=>"มิ.ย.",
		"7"=>"ก.ค.",
		"8"=>"ส.ค.",
		"9"=>"ก.ย.",
		"10"=>"ต.ค.",
		"11"=>"พ.ย.",
		"12"=>"ธ.ค."
	);
	
	function thai_date_fullmonth($time){   // 19 ธันวาคม 2556
		global $thai_day_arr,$thai_month_arr;
		$thai_month_arra = array("",
		"มกราคม",
		"กุมภาพันธ์",
		"มีนาคม",
		"เมษายน",
		"พฤษภาคม",
		"มิถุนายน",
		"กรกฎาคม",
		"สิงหาคม",
		"กันยายน",
		"ตุลาคม",
		"พฤศจิกายน",
		"ธันวาคม"
	);
		$monthnum = (date("n",$time));
		$thai_date_return = date("j",$time);
		$thai_date_return.=" ".$thai_month_arra[date("n",$time)];
		$thai_date_return.= " ".(date("Y",$time)+543);
		return $thai_date_return;
	}

	echo "<div id='wz-gpw'><span id='wz-gpw-title'>ราคาทองประจำวันที่ </span>";
	
	echo "<span id='wz-gpw-date'>".thai_date_fullmonth(time());
	
	$url = 'http://www.thaigold.info/RealTimeDataV2/gtdata_.txt'; //ประกาศ url
	
	$data_json = file_get_contents($url); //ดึงข้อมูลจาก url ได้ข้อมูลมาเป็น json
	
	$data_array = json_decode($data_json); //เปลี่ยน json เป็น array
	
	
	//var_dump($data_array);
	
	$logo = plugin_dir_url( dirname( __FILE__ ) ) . 'img/gold-icon.png';

	foreach($data_array as $val)
	{
		if ($val->{'name'} == "Update"){
			echo " ณ เวลา ". $val->{'ask'}."</span>";
		}
	

		if ($val->{'name'} == "สมาคมฯ"){
			echo "<div class='container'>
			<div class='row'>
			  <div class='col-xl-3 col-12 col-sm-3'>
				  <img id='wz-gpw-img' src='".$logo."'>
			  </div>
			  <div class='col-xl-7 col-9 col-sm-7'>
				  <div class='row'>
					  <div class='col-xl-6 col-6'>
						  <span id='wz-gpw-text'>รับซื้อ</span>
					  </div>
					  <div class='col-xl-6 col-6'>
						  <span id='wz-gpw-price'>".$val->{'bid'}."</span>
					  </div>
				  </div>
				  <div class='row'>
					  <div class='col-xl-6 col-6'>
						  <span id='wz-gpw-text'>ขายออก</span>
					  </div>
					  <div class='col-xl-6 col-6'>
						  <span id='wz-gpw-price'>".$val->{'ask'}."</span>
					  </div>
				  </div>
			  </div>
			  <div class='col-xl col-3 col-sm'>
				  <span id='wz-gpw-alert'>".$val->{'diff'}."</span>
			  </div>
			</div>
		  </div>";
		}
	}

	echo "</div>";
	return ob_get_clean();
}
add_shortcode( 'wz-gold-price', 'wz_gold_price_api' );