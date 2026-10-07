<?php
declare(strict_types=1);

/*
 * ControlPay - versão pública demonstrativa
 *
 * Interface renderizada em PHP.
 * Não possui conexão com banco de dados, LDAP ou sistemas internos.
 */

$stats = [
    ['label' => 'Total de registros', 'value' => '248', 'change' => '↑ 8,4% este mês', 'class' => 'blue', 'trend' => 'up', 'icon' => '▤'],
    ['label' => 'Homologados', 'value' => '186', 'change' => '↑ 12,1% este mês', 'class' => 'green', 'trend' => 'up', 'icon' => '✓'],
    ['label' => 'Em análise', 'value' => '42', 'change' => 'aguardando revisão', 'class' => 'amber', 'trend' => 'neutral', 'icon' => '◷'],
    ['label' => 'Pendências', 'value' => '20', 'change' => '↓ 3,2% este mês', 'class' => 'red', 'trend' => 'down', 'icon' => '!'],
];

$activities = [
    ['title' => 'Homologação #0248', 'description' => 'Registro concluído', 'time' => 'Hoje, 09:42', 'class' => 'green'],
    ['title' => 'Homologação #0247', 'description' => 'Enviada para análise', 'time' => 'Hoje, 08:17', 'class' => 'blue'],
    ['title' => 'Homologação #0246', 'description' => 'Aguardando documentação', 'time' => 'Ontem, 16:31', 'class' => 'amber'],
    ['title' => 'Homologação #0245', 'description' => 'Registro concluído', 'time' => 'Ontem, 14:08', 'class' => 'green'],
];

$chart = [
    ['month' => 'Jan', 'height' => 42], ['month' => 'Fev', 'height' => 58],
    ['month' => 'Mar', 'height' => 49], ['month' => 'Abr', 'height' => 72],
    ['month' => 'Mai', 'height' => 64], ['month' => 'Jun', 'height' => 88],
];

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="ControlPay — versão pública demonstrativa em PHP">
  <title>ControlPay — Demonstração PHP</title>
  <link rel="icon" href="assets/favicon.png">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="demo-banner"><span>●</span> Versão demonstrativa — dados fictícios, sem conexão com sistemas externos</div>
  <div class="app">
    <aside class="sidebar" id="sidebar">
      <div class="brand"><div class="brand-mark">CP</div><div><strong>ControlPay</strong><small>Gestão e homologação</small></div></div>
      <nav class="menu">
        <button class="menu-item active" data-page="dashboard"><span>⌂</span> Dashboard</button>
        <button class="menu-item" data-page="homologacoes"><span>▤</span> Homologações</button>
        <button class="menu-item" data-page="nova"><span>＋</span> Nova homologação</button>
        <button class="menu-item" data-page="relatorios"><span>◫</span> Relatórios</button>
        <div class="menu-label">SISTEMA</div>
        <button class="menu-item" data-page="config"><span>⚙</span> Configurações</button>
      </nav>
      <div class="sidebar-footer">
        <div class="demo-user"><div class="avatar">D</div><div><strong>Usuário demo</strong><small>Acesso demonstrativo</small></div></div>
        <button class="logout" id="logout">↪ Sair da demonstração</button>
      </div>
    </aside>

    <main class="main">
      <header class="topbar">
        <button class="icon-btn" id="mobileMenu" aria-label="Abrir menu">☰</button>
        <div class="breadcrumb"><span id="pageParent">Visão geral</span><b>/</b><strong id="pageTitle">Dashboard</strong></div>
        <div class="top-actions"><button class="icon-btn" id="themeToggle" title="Alternar tema">☼</button><div class="top-avatar">D</div></div>
      </header>

      <section class="content">
        <div id="dashboard" class="page active-page">
          <div class="page-head"><div><span class="eyebrow">VISÃO GERAL</span><h1>Dashboard</h1><p>Acompanhe os principais indicadores do sistema.</p></div><button class="primary" data-page="nova">＋ Nova homologação</button></div>
          <div class="cards">
<?php foreach ($stats as $stat): ?>
            <article class="stat-card"><div class="stat-icon <?= e($stat['class']) ?>"><?= e($stat['icon']) ?></div><div><small><?= e($stat['label']) ?></small><strong><?= e($stat['value']) ?></strong><span class="<?= e($stat['trend']) ?>"><?= e($stat['change']) ?></span></div></article>
<?php endforeach; ?>
          </div>
          <div class="grid-2">
            <section class="panel">
              <div class="panel-head"><div><h2>Atividade recente</h2><p>Últimas movimentações demonstrativas</p></div><button class="text-btn" data-page="homologacoes">Ver todas →</button></div>
              <div class="activity">
<?php foreach ($activities as $activity): ?>
                <div class="activity-row"><span class="dot <?= e($activity['class']) ?>"></span><div><strong><?= e($activity['title']) ?></strong><small><?= e($activity['description']) ?></small></div><time><?= e($activity['time']) ?></time></div>
<?php endforeach; ?>
              </div>
            </section>
            <section class="panel"><div class="panel-head"><div><h2>Status dos registros</h2><p>Distribuição atual</p></div></div><div class="bars">
              <div><div><span>Homologados</span><b>75%</b></div><i><em style="width:75%"></em></i></div>
              <div><div><span>Em análise</span><b>17%</b></div><i><em style="width:17%"></em></i></div>
              <div><div><span>Pendentes</span><b>8%</b></div><i><em style="width:8%"></em></i></div>
            </div></section>
          </div>
        </div>

        <div id="homologacoes" class="page">
          <div class="page-head"><div><span class="eyebrow">CONTROLPAY</span><h1>Homologações</h1><p>Pesquise e consulte registros demonstrativos.</p></div><button class="primary" data-page="nova">＋ Novo registro</button></div>
          <section class="panel"><div class="panel-head"><div><h2>Filtros para pesquisa</h2><p>Use os campos abaixo para localizar um registro.</p></div><button class="ghost" id="clearFilters">Limpar</button></div>
            <div class="filters">
              <label>Título<input id="filterTitle" placeholder="Título"></label>
              <label>Nº Protocolo<input id="filterProtocol" placeholder="Ex.: 2026-0001"></label>
              <label>Nome<input id="filterName" placeholder="Nome"></label>
              <label>Status<select id="filterStatus"><option value="">Todos</option><option>Homologado</option><option>Em análise</option><option>Pendente</option></select></label>
              <button class="primary" id="searchBtn">Pesquisar</button>
            </div>
          </section>
          <section class="panel table-panel"><div class="panel-head"><div><h2>Registros</h2><p id="resultCount">4 registros encontrados</p></div></div>
            <div class="table-wrap"><table><thead><tr><th>ID</th><th>Título</th><th>Nome</th><th>Protocolo</th><th>Status</th><th>Atualização</th><th></th></tr></thead><tbody id="records"></tbody></table></div>
          </section>
        </div>

        <div id="nova" class="page">
          <div class="page-head"><div><span class="eyebrow">CONTROLPAY</span><h1>Nova homologação</h1><p>Formulário demonstrativo sem envio para sistemas externos.</p></div></div>
          <form class="panel form-panel" id="newForm">
            <div class="panel-head"><div><h2>Dados do registro</h2><p>Todos os valores abaixo permanecem apenas no navegador.</p></div><span class="local-badge">● armazenamento local</span></div>
            <div class="form-grid">
              <label>Título *<input required name="title" placeholder="Título da homologação"></label><label>Nº Protocolo *<input required name="protocol" placeholder="2026-0000"></label>
              <label>Nome *<input required name="name" placeholder="Nome demonstrativo"></label><label>Responsável<input name="responsible" placeholder="Responsável"></label>
              <label>Data de entrada<input type="date" name="date"></label><label>Status<select name="status"><option>Em análise</option><option>Homologado</option><option>Pendente</option></select></label>
              <label class="full">Descrição<textarea name="description" rows="5" placeholder="Descrição do registro..."></textarea></label>
            </div>
            <div class="form-actions"><button type="button" class="ghost" data-page="homologacoes">Cancelar</button><button class="primary">Salvar demonstração</button></div>
          </form>
        </div>

        <div id="relatorios" class="page">
          <div class="page-head"><div><span class="eyebrow">CONTROLPAY</span><h1>Relatórios</h1><p>Indicadores visuais baseados em dados fictícios.</p></div><button class="ghost" id="exportDemo">Exportar CSV</button></div>
          <div class="cards"><article class="stat-card"><div class="stat-icon blue">◫</div><div><small>Registros no período</small><strong>64</strong><span class="neutral">últimos 30 dias</span></div></article><article class="stat-card"><div class="stat-icon green">✓</div><div><small>Taxa de homologação</small><strong>82%</strong><span class="up">↑ 5,7%</span></div></article></div>
          <section class="panel"><div class="panel-head"><div><h2>Resumo mensal</h2><p>Dados exclusivamente demonstrativos</p></div></div><div class="chart"><div class="chart-bars">
<?php foreach ($chart as $item): ?><i style="height:<?= (int) $item['height'] ?>%"><b><?= e($item['month']) ?></b></i><?php endforeach; ?>
          </div></div></section>
        </div>

        <div id="config" class="page">
          <div class="page-head"><div><span class="eyebrow">SISTEMA</span><h1>Configurações</h1><p>Preferências desta demonstração.</p></div></div>
          <section class="panel settings">
            <div class="setting"><div><strong>Aparência</strong><small>Use o botão no topo para alternar entre os temas.</small></div><span class="pill">Ativo</span></div>
            <div class="setting"><div><strong>Dados externos</strong><small>Desativados nesta versão pública.</small></div><span class="pill muted">Desativado</span></div>
            <div class="setting"><div><strong>Persistência</strong><small>Novos registros ficam somente no armazenamento local do navegador.</small></div><span class="pill">Local</span></div>
          </section>
        </div>
      </section>
      <footer>ControlPay · versão demonstrativa em PHP · sem conexão com sistemas externos</footer>
    </main>
  </div>
  <script src="js/app.js"></script>
</body>
</html>
