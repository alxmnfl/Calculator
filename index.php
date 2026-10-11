<?php
$result = null;
$error = "";

$num1 = "";
$num2 = "";
$operator = "+";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $num1 = trim($_POST["num1"] ?? "");
    $num2 = trim($_POST["num2"] ?? "");
    $operator = $_POST["operator"] ?? "+";

    if (
        $num1 === "" ||
        $num2 === "" ||
        !is_numeric($num1) ||
        !is_numeric($num2)
    ) {
        $error = "Please enter valid numbers.";
    } else {
        $a = (float) $num1;
        $b = (float) $num2;

        switch ($operator) {
            case "+":
                $result = $a + $b;
                break;
            case "-":
                $result = $a - $b;
                break;
            case "*":
                $result = $a * $b;
                break;
            case "/":
                if ($b == 0) {
                    $error = "Division by zero is not allowed.";
                } else {
                    $result = $a / $b;
                }
                break;
            default:
                $error = "Invalid operator.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #111827;
            color: white;
            font-family: Arial, sans-serif;
        }

        .calculator {
            width: 340px;
            max-width: calc(100% - 32px);
            padding: 28px;
            background: #1f2937;
            border-radius: 16px;
            box-shadow: 0 10px 30px #0004;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin: 16px 0 8px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }

        input,
        select {
            background: #374151;
            color: white;
            outline: 1px solid #4b5563;
        }

        button {
            margin-top: 20px;
            background: #38bdf8;
            color: #082f49;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #7dd3fc;
        }

        .result {
            margin-top: 20px;
            padding: 14px;
            background: #064e3b;
            border-radius: 8px;
            overflow-wrap: anywhere;
        }

        .error {
            margin-top: 20px;
            padding: 14px;
            background: #7f1d1d;
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <main class="calculator">
        <h1>PHP Calculator</h1>

        <form method="POST">
            <label for="num1">First Number</label>
            <input type="number" step="any" id="num1" name="num1" value="<?= htmlspecialchars($num1) ?>" required>

            <label for="operator">Operation</label>
            <select id="operator" name="operator">
                <option value="+" <?= $operator === "+" ? "selected" : "" ?>>Addition (+)</option>
                <option value="-" <?= $operator === "-" ? "selected" : "" ?>>Subtraction (-)</option>
                <option value="*" <?= $operator === "*" ? "selected" : "" ?>>Multiplication (×)</option>
                <option value="/" <?= $operator === "/" ? "selected" : "" ?>>Division (÷)</option>
            </select>

            <label for="num2">Second Number</label>
            <input type="number" step="any" id="num2" name="num2" value="<?= htmlspecialchars($num2) ?>" required>

            <button type="submit">Calculate</button>
        </form>

        <?php if ($error !== ""): ?>
            <div class="error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php elseif ($result !== null): ?>
            <div class="result">
                <strong>Result:</strong>
                <?= htmlspecialchars((string) $result) ?>
            </div>
        <?php endif; ?>

    </main>

</body>

</html>