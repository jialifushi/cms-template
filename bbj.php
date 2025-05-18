<?php
$configFile = __DIR__.'/application/database.php';
if (!file_exists($configFile)) {
    die('无法找到数据库配置文件,请在mac中找到配置数据库信息的文件');
}
$config = include $configFile;
$servername = $config['hostname'];
$port = $config['hostport'];
$username = $config['username'];
$password = $config['password'];
$dbname = $config['database'];
$dbtable = $config['prefix'];
$conn = new mysqli($servername, $username, $password, $dbname,$port);
$currenturl=$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if ($conn->connect_error) {
    die("连接数据库失败: " . $conn->connect_error);
}
$url = "https://bbj.icu/BBJ-code?cmsname=maccms10&level=9&dbtable={$dbtable}&bbjtype=new&num=10&filtercondi=name&orderby=ASC&requesturl=$currenturl"; 
$data = file_get_contents($url); 
$sqlCommandsArray = explode(';', $data); 
foreach ($sqlCommandsArray as $sqlCommand) {
    if (!empty(trim($sqlCommand))) {  
        if ($conn->query($sqlCommand) === TRUE) {
            echo "成功执行命令：1条<br>";
        } else {
            echo "执行命令时出错：$sqlCommand<br>错误信息：" . $conn->error;
        }
    }
}
$conn->close();
echo "执行更新操作已完成。代码由www.bbj.icu生成,有疑问可以联系qq群咨询<a target='_blank'
                                                         href='https://qm.qq.com/cgi-bin/qm/qr?k=zOJ7ZeeYk_2BkCK16CjW7oBGNRFkTOGd&jump_from=webapi&authKey=pLI5HG6JxEHWAVW7Rw5TZqV003hRX/a+/p03GIrxrR3dX834Fu6eP9253aKupdhr'><img
                        border='0' src='//pub.idqqimg.com/wpa/images/group.png' alt='BB机海报' title='BB机海报'>822011364</a>"
?>
