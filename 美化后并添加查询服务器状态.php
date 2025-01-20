<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API查询与服务器状态</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #333;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .image-result img {
            max-width: 100%;
            border-radius: 5px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        pre {
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>API查询与服务器状态</h1>

        <!-- 查询用户信息的表单 -->
        <div class="form-group">
            <h2>查询用户信息</h2>
            <form method="GET" action="">
                <label for="name">用户名：</label>
                <input type="text" id="name" name="name" placeholder="输入用户名" required>
                <br><br>
                <label for="qq">QQ号：</label>
                <input type="text" id="qq" name="qq" placeholder="输入QQ号" required>
                <br><br>
                <button type="submit">查询</button>
            </form>
        </div>

        <!-- 显示用户信息的查询结果 -->
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

        <!-- 查询服务器状态图片的表单 -->
        <div class="form-group">
            <h2>查询服务器状态图片</h2>
            <form method="GET" action="">
                <label for="host">服务器地址 (IP:端口)：</label>
                <input type="text" id="host" name="host" placeholder="例如：103.40.14.92:19132" required>
                <br><br>
                <button type="submit">获取状态图片</button>
            </form>
        </div>

        <!-- 显示服务器状态图片 -->
        <?php
        if (isset($_GET['host'])) {
            $host = urlencode($_GET['host']);
            $imageUrl = "https://motdbe.blackbe.work/status_img?host=$host";
            echo "<div class='image-result'>";
            echo "<h3>服务器状态图片：</h3>";
            echo "<img src='$imageUrl' alt='服务器状态图片'>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
