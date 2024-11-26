<?php 

  require('inc/essentials.php');
  require('inc/db_config.php');
  require('inc/mpdf/vendor/autoload.php');

  adminLogin();

  if(isset($_GET['gen_pdf']) && isset($_GET['id']))
  {
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*,uc.email FROM `booking_order` bo
      INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
      INNER JOIN `user_cred` uc ON bo.user_id = uc.id
      WHERE ((bo.booking_status='booked' AND bo.arrival=1) 
      OR (bo.booking_status='cancelled' AND bo.refund=1)
      OR (bo.booking_status='payment failed')) 
      AND bo.booking_id = '$frm_data[id]'";

    $res = mysqli_query($con,$query);
    $total_rows = mysqli_num_rows($res);

    if($total_rows==0){
      header('location: dashboard.php');
      exit;
    }

    $data = mysqli_fetch_assoc($res);

    $date = date("h:ia | d-m-Y",strtotime($data['datentime']));
    $checkin = date("d-m-Y",strtotime($data['check_in']));
    $checkout = date("d-m-Y",strtotime($data['check_out']));

    $table_data = "
    <h2>HÓA ĐƠN ĐẶT PHÒNG</h2>
    <table border='1'>
      <tr>
        <td>ID đơn đặt: $data[order_id]</td>
        <td>Ngày đặt: $date</td>
      </tr>
      <tr>
        <td colspan='2'>Trạng thái: $data[booking_status]</td>
      </tr>
      <tr>
        <td>Tên: $data[user_name]</td>
        <td>Email: $data[email]</td>
      </tr>
      <tr>
        <td>Số điện thoại: $data[phonenum]</td>
        <td>Địa chỉ: $data[address]</td>
      </tr>
      <tr>
        <td>Tên phòng: $data[room_name]</td>
        <td>Giá: $data[price] VND /đêm</td>
      </tr>
      <tr>
        <td>Check-in: $checkin</td>
        <td>Check-out: $checkout</td>
      </tr>
    ";

    if($data['booking_status']=='cancelled')
    {
      $refund = ($data['refund']) ? "Amount Refunded" : "Not Yet Refunded";

      $table_data.="<tr>
        <td>Số tiền đã hoàn: $data[trans_amt] VND</td>
        <td>Đơn hoàn: $refund</td>
      </tr>";
    }
    else if($data['booking_status']=='payment failed')
    {
      $table_data.="<tr>
        <td>Số tiền giao dịch: $data[trans_amt] VND</td>
        <td>Phản hồi thất bại: $data[trans_resp_msg]</td>
      </tr>";
    }
    else
    {
      $table_data.="<tr>
        <td>Số phòng: $data[room_no]</td>
        <td>Số tiền đã trả: $data[trans_amt] VND</td>
      </tr>";
    }

    $table_data.="</table>";

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($table_data);
    $mpdf->Output($data['order_id'].'.pdf','D');

  }
  else{
    header('location: dashboard.php');
  }
  
?>