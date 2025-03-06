<?php
$exchange_rates = [
    "USD_CAD" => 1.44,
    "USD_EUR" => 0.92,
    "CAD_USD" => 0.70,
    "CAD_EUR" => 0.64,
    "EUR_USD" => 1.08,
    "EUR_CAD" => 1.55
];

$from_value = isset($_GET['from_value']) ? floatval($_GET['from_value']) : '';
$from_currency = isset($_GET['from_currency']) ? $_GET['from_currency'] : 'USD';
$to_currency = isset($_GET['to_currency']) ? $_GET['to_currency'] : 'USD';
$converted_value = '';

if (!empty($from_value) && $from_currency !== $to_currency) {
    $conversion_key = "{$from_currency}_{$to_currency}";
    if (isset($exchange_rates[$conversion_key])) {
        $converted_value = $from_value * $exchange_rates[$conversion_key];
    } else {
        $converted_value = "Conversion rate not available!";
    }
} elseif ($from_currency === $to_currency && !empty($from_value)) {
    $converted_value = $from_value; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Currency Converter</title>
    <meta charset="UTF-8">
    <meta name="description" content="CENG 311 Inclass Activity 5">
</head>
<body>
    <h2>Currency Converter</h2>
    <form action="activity5.php" method="GET">
        <table>
            <tr>
                <td>From:</td>
                <td><input type="text" name="from_value" value="<?php echo htmlspecialchars($from_value); ?>" required /></td>
                <td>Currency:</td>
                <td>
                    <select name="from_currency">
                        <option value="USD" <?php if ($from_currency == "USD") echo "selected"; ?>>US Dollar</option>
                        <option value="CAD" <?php if ($from_currency == "CAD") echo "selected"; ?>>Canadian Dollar</option>
                        <option value="EUR" <?php if ($from_currency == "EUR") echo "selected"; ?>>Euro</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>To:</td>
                <td><input type="text" name="to_value" value="<?php echo htmlspecialchars($converted_value); ?>" disabled /></td>
                <td>Currency:</td>
                <td>
                    <select name="to_currency">
                        <option value="USD" <?php if ($to_currency == "USD") echo "selected"; ?>>US Dollar</option>
                        <option value="CAD" <?php if ($to_currency == "CAD") echo "selected"; ?>>Canadian Dollar</option>
                        <option value="EUR" <?php if ($to_currency == "EUR") echo "selected"; ?>>Euro</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;">
                    <input type="submit" value="Convert" />
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
