<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře a zabezpečení proti XSS
    $jmeno = htmlspecialchars(trim($_POST['jmeno']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $zprava = htmlspecialchars(trim($_POST['zprava']));

    // Nastavení příjemce a předmětu emailu
    $to = "zednickesluzby@email.cz";  // <-- sem napiš svůj email
    $subject = "Nová zpráva z kontaktního formuláře";

    // Sestavení zprávy
    $message = "Jméno: $jmeno\n";
    $message .= "Email: $email\n\n";
    $message .= "Zpráva:\n$zprava\n";

    // Hlavičky emailu
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Odeslání emailu
    if (mail($to, $subject, $message, $headers)) {
        // Přesměrování po úspěšném odeslání
        header("Location: dekujeme.html");
        exit;
    } else {
        echo "Nastala chyba při odesílání zprávy.";
    }
} else {
    echo "Nepovolený přístup.";
}
?>
