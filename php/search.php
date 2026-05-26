<?php
require_once 'db.php';

// if preview parameter is set, return small html fragments for client-side quick preview
if(isset($_GET['preview'])){
    $q = $_GET['q'] ?? '';
    $stmt = $pdo->prepare("SELECT t.id,t.title,t.subjects,t.hourly_rate,t.bio,t.rating,t.video_url,u.city,u.name FROM tutors t JOIN users u ON t.user_id=u.id WHERE (t.subjects LIKE ? OR u.city LIKE ?) LIMIT 6");
    $like = "%".$q."%";
    $stmt->execute([$like,$like]);
    $rows = $stmt->fetchAll();
    if(!$rows) { echo '<p>No preview results.</p>'; exit; }
    foreach($rows as $r){
        echo '<div class="card"><h4>'.htmlspecialchars($r['name']).' - '.htmlspecialchars($r['title']).'</h4>';
        echo '<p>'.htmlspecialchars($r['subjects']).' | '.$r['city'].'</p>';
        echo '<p>SR '.number_format($r['hourly_rate'],2).' | Rating: '.($r['rating'] ?? 0).'</p>';
        echo '</div>';
    }
    exit;
}

// full search UI and server-side filtering
$subject = $_GET['subject'] ?? '';
$city = $_GET['city'] ?? '';
$mode = $_GET['mode'] ?? '';
$minp = $_GET['minp'] ?? 0;
$maxp = $_GET['maxp'] ?? 99999;

$query = "SELECT t.*, u.name, u.city FROM tutors t JOIN users u ON t.user_id=u.id WHERE t.hourly_rate BETWEEN ? AND ?";
$params = [$minp,$maxp];
if($subject){ $query .= " AND t.subjects LIKE ?"; $params[] = "%$subject%"; }
if($city){ $query .= " AND u.city LIKE ?"; $params[] = "%$city%"; }
if($mode){ $query .= " AND t.teaching_mode = ?"; $params[] = $mode; }
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$results = $stmt->fetchAll();
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Search Tutors</title>
<link rel="stylesheet" href="../css/style.css">
</head><body>
<header><h2>Search Tutors</h2></header>
<main>
<form method="get" action="search.php">
  <label>Subject: <input name="subject" value="<?=htmlspecialchars($subject)?>"></label>
  <label>City: <input name="city" value="<?=htmlspecialchars($city)?>"></label>
  <label>Mode:
    <select name="mode">
      <option value="">Any</option>
      <option value="online" <?= $mode=='online'?'selected':''?>>Online</option>
      <option value="in-person" <?= $mode=='in-person'?'selected':''?>>In-person</option>
      <option value="hybrid" <?= $mode=='hybrid'?'selected':''?>>Hybrid</option>
    </select>
  </label>
  <label>Price min: <input name="minp" type="number" value="<?=htmlspecialchars($minp)?>"></label>
  <label>Price max: <input name="maxp" type="number" value="<?=htmlspecialchars($maxp)?>"></label>
  <button>Search</button>
</form>

<div>
  <button onclick="doCompare()">Compare Selected</button>
  <div style="margin-top:8px;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:0.6rem;">
  <?php foreach($results as $r): ?>
    <div class="card">
      <input type="checkbox" class="compare-cb" data-id="<?=$r['id']?>" onclick="toggleCompareCheckbox(this)">
      <h3 id="tname-<?=$r['id']?>"><?=htmlspecialchars($r['name'])?></h3>
      <p id="tsub-<?=$r['id']?>"><?=htmlspecialchars($r['subjects'])?></p>
      <p id="trate-<?=$r['id']?>">SR <?=number_format($r['hourly_rate'],2)?></p>
      <p id="tbio-<?=$r['id']?>"><?=htmlspecialchars(substr($r['bio'],0,120))?></p>
      <div id="tvideo-<?=$r['id']?>" data-src="<?=htmlspecialchars($r['video_url'])?>">
        <?php if($r['video_url']): ?>
          <video width="100%" controls src="../<?=htmlspecialchars($r['video_url'])?>"></video>
        <?php endif; ?>
      </div>
      <p>Rating: <?=htmlspecialchars($r['rating'])?></p>
      <a href="tutor_profile.php?id=<?=$r['id']?>">View profile</a>
    </div>
  <?php endforeach; ?>
  </div>
</div>
</main>
<script src="../js/compare.js"></script>
</body></html>
