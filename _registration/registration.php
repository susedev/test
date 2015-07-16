<!doctype html>
<meta charset="utf-8">

<?php

include('config.php');

$email_subject = "Conference registration";

if(isset($_GET['lang']) && $_GET['lang'] == 'en') {
  $txt = array(
    'page_title' => 'Registration',
    'title' => 'Title',
    'first_name' => 'First Name',
    'last_name' => 'Last Name',
    'email' => 'Email',
    'organization' => 'Organization / Institution',
    'address' => 'Address',
    'postcode' => 'Post Code',
    'city' => 'City',
    'ticket' => 'Ticket',
    'early_bird_info' => 'Early-Bird-Tickets are available until 31.08.2015.',
    'success' => 'Thank you for your registration. You have been registered successfully as participant at the Conference "Communication Floods" at Mediacampus Villa Ida, Poetenweg 28, 04155 Leipzig on Friday, 6 November 2015.',
    'formtext' => 'You send us the following information:',
    'invoice_soon' => 'You will recieve an invoice soon. Please transfer the fee [ticket] within 7 days to this account:',
    'form_footer' => 'Note: Please make sure your details are correct before submitting form and that all fields marked with * are completed!',
    'form_footer_2' => 'A registration confirmation/invoice will be sent by email after the Conference Stuff has received the fully completed registration form.',
    'title_options' => ['Mrs.', 'Mr.', 'Prof.', 'Dr.'],
    'ticket_options' => [
      'Early-Bird Regular (60 €)',
      'Regular (80 €)',
      'Post-docs/Students (40 €)',
    ],
    'required_field' => 'Required field',
    'submit' => 'Submit',
  );
}
else {
  $txt = array(
    'page_title' => 'Anmeldung',
    'title' => 'Anrede',
    'first_name' => 'Vorname',
    'last_name' => 'Name',
    'email' => 'Email',
    'organization' => 'Organisation / Institution',
    'address' => 'Adresse',
    'postcode' => 'PLZ',
    'city' => 'Stadt',
    'ticket' => 'Ticket',
    'early_bird_info' => 'Frühbucher-Tickets sind bis zum 31.08.2015 erhältlich.',
    'success' => 'Vielen Dank für Ihre Anmeldung zur Tagung "KommunikationsFluten" am 6. November 2015, Mediacampus Villa Ida, Poetenweg 28, 04155 Leipzig.',
    'formtext' => 'Sie haben uns folgende Informationen zu Ihrer Person übermittelt:',
    'invoice_soon' => 'In Kürze erhalten Sie eine Anmeldebestätigung sowie eine Rechnung an die von Ihnen angegebene E-Mail-Adresse. Wir möchten Sie bitten, die darin vermerkte Tagungsgebühr innerhalb von 7 Tagen auf folgendes Konto zu überweisen:',
    'form_footer' => 'Hinweis: Bitte füllen Sie alle mit * markierten Felder aus und überprüfen Sie Ihre Angaben vor dem Absenden auf ihre Richtigkeit.',
    'form_footer_2' => 'Nach der erfolgreichen Anmeldung erhalten Sie eine Anmeldungsbestätigung sowie eine Rechnung an die von Ihnen angegebene E-Mail-Adresse.',
    'title_options' => ['Frau', 'Herr', 'Prof.', 'Dr.'],
    'ticket_options' => [
      'Frühbucher (60 €)',
      'Normal (80 €)',
      'Post-docs/Studenten (40 €)',
    ],
    'required_field' => 'Pflichtfeld',
    'submit' => 'Anmelden',
  );
}

$account =
  "IBAN DE65 8605 5592 1100 4034 14\n" .
  "BIC WELADE8LXXX";

$fields = [
  'title',
  'first_name',
  'last_name',
  'email',
  'organization',
  'address',
  'postcode',
  'city',
  'ticket',
];
?>

<title>Konferenz: KommunikationsFluten &middot; <?= $txt['page_title'] ?></title>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/css/bootstrap.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.js"></script>

<body>

<?php

function select_html($name, $options, $data) { ?>
  <select class="form-control" id="<?= $name ?>" name="<?= $name ?>">
    <?php foreach($options as $opt) { ?>
      <option value="<?= $opt ?>" <?= $data[$name] == $opt ? 'selected' : '' ?>>
        <?= $opt ?>
      </option>
    <?php } ?>
  </select>
<?php }

function render_html($data, $err) {
  global $txt;
  ?>
  <form class="form" method="post">
    <div class="form-group">
      <label for="title"><?= $txt['title'] ?> *:</label>
      <?php select_html('title', $txt['title_options'], $data) ?>
    </div>

    <div class="form-group">
      <label for="first_name"><?= $txt['first_name'] ?> *:</label>
      <input class="form-control" id="first_name" name="first_name" value="<?= $data['first_name'] ?>">
    </div>

    <div class="form-group">
      <label for="last_name"><?= $txt['last_name'] ?> *:</label>
      <input class="form-control" id="last_name" name="last_name" value="<?= $data['last_name'] ?>">
    </div>

    <div class="form-group">
      <label for="email"><?= $txt['email'] ?> *:</label>
      <input class="form-control" id="email" type="email" name="email" value="<?= $data['email'] ?>">
    </div>

    <div class="form-group">
      <label for="organization"><?= $txt['organization'] ?> *:</label>
      <input class="form-control" id="organization" name="organization" value="<?= $data['organization'] ?>">
    </div>

    <div class="form-group">
      <label for="address"><?= $txt['address'] ?> *:</label>
      <input class="form-control" id="address" name="address" value="<?= $data['address'] ?>">
    </div>

    <div class="form-group">
      <label for="postcode"><?= $txt['postcode'] ?> *:</label>
      <input class="form-control" id="postcode" name="postcode" value="<?= $data['postcode'] ?>">
    </div>

    <div class="form-group">
      <label for="city"><?= $txt['city'] ?> *:</label>
      <input class="form-control" id="city" name="city" value="<?= $data['city'] ?>">
    </div>

    <div class="form-group">
      <label for="ticket"><?= $txt['ticket'] ?> *:</label>
      <?php select_html('ticket', $txt['ticket_options'], $data) ?>
    </div>

    <p><?= $txt['early_bird_info'] ?></p>

    <p><?= $txt['form_footer'] ?></p>

    <?php foreach($err as $e) { ?>
      <p class="text-danger"><?= $e ?></p>
    <?php } ?>

    <button type="submit" class="btn btn-primary"><?= $txt['submit'] ?></button>

    <p><?= $txt['form_footer_2'] ?></p>
  </form>
<?php }


if($_SERVER['REQUEST_METHOD'] == 'POST') {
  $err = [];
  foreach($fields as $fieldname) {
    if(! $_POST[$fieldname]) {
      $err[] = "${txt['required_field']}: ${txt[$fieldname]}";
    }
  }

  if(count($err) > 0) {
    render_html($_POST, $err);
  }
  else {
    $formtext = "";
    foreach($fields as $fieldname) {
      $formtext .= "${txt[$fieldname]}: ${_POST[$fieldname]}\n";
    }

    $body = "Conference registration\n\n" . $formtext;

    $headers = 'From: '.$email_from."\r\n".
        "Content-Type: text/plain; charset=UTF-8\r\n" .
        "Content-Transfer-Encoding: base64\r\n\r\n";

    mail($email_to, $email_subject, chunk_split(base64_encode($body)), $headers);

    ?>
      <p><?= $txt['success'] ?></p>
      <p><?= $txt['formtext'] ?></p>
      <pre><?= $formtext ?></pre>
      <p><?= $txt['invoice_soon'] ?></p>
      <pre><?= $account ?></pre>
    <?php
  }
} else {
  $data = [];
  foreach($fields as $fieldname) {
    $data[$fieldname] = '';
  }
  render_html($data, []);
} ?>
