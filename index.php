<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API查询结果</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .result {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>API查询结果</h1>
    <form method="GET" action="">
        <label for="name">用户名：</label>
        <input type="text" id="name" name="name" placeholder="输入用户名" required>
        <br><br>
        <label for="qq">QQ号：</label>
        <input type="text" id="qq" name="qq" placeholder="输入QQ号" required>
        <br><br>
        <button type="submit">查询</button>
    </form>

    <?php
    if (isset($_GET['name']) && isset($_GET['qq'])) {
        // 获取用户输入
        $name = urlencode($_GET['name']);
        $qq = urlencode($_GET['qq']);

        // API URL
        $apiUrl = "https://api.blackbe.work/openapi/v3/check?name=$name&qq=$qq";

        // 发送请求
        $response = file_get_contents($apiUrl);

        // 解析JSON响应
        $data = json_decode($response, true);

        // 显示结果
        echo "<div class='result'>";
        if (isset($data['error'])) {
            echo "<p>错误：" . $data['error'] . "</p>";
        } else {
            echo "<pre>" . htmlspecialchars(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT)) . "</pre>";
        }
        echo "</div>";
    }
    ?>
</body>
</html>
