const records = [
  {id:248,title:"Homologação demonstrativa A",name:"Usuário Exemplo",protocol:"2026-0248",status:"Homologado",date:"Hoje, 09:42"},
  {id:247,title:"Homologação demonstrativa B",name:"Pessoa Fictícia",protocol:"2026-0247",status:"Em análise",date:"Hoje, 08:17"},
  {id:246,title:"Homologação demonstrativa C",name:"Cadastro Exemplo",protocol:"2026-0246",status:"Pendente",date:"Ontem, 16:31"},
  {id:245,title:"Homologação demonstrativa D",name:"Nome Fictício",protocol:"2026-0245",status:"Homologado",date:"Ontem, 14:08"}
];
const $=s=>document.querySelector(s), $$=s=>document.querySelectorAll(s);
const labels={dashboard:["Visão geral","Dashboard"],homologacoes:["ControlPay","Homologações"],nova:["ControlPay","Nova homologação"],relatorios:["ControlPay","Relatórios"],config:["Sistema","Configurações"]};

function statusClass(s){return s==="Homologado"?"green":s==="Pendente"?"amber":"blue"}
function renderRows(list=records){
  const body=$("#records"); if(!body)return;
  body.innerHTML=list.map(r=>`<tr><td>#${r.id}</td><td><strong>${r.title}</strong></td><td>${r.name}</td><td>${r.protocol}</td><td><span class="status ${statusClass(r.status)}">${r.status}</span></td><td>${r.date}</td><td><button class="row-action" onclick="demoNotice()">Ver</button></td></tr>`).join("");
  $("#resultCount").textContent=`${list.length} registro${list.length===1?"":"s"} encontrado${list.length===1?"":"s"}`;
}
function showPage(id){
  $$(".page").forEach(p=>p.classList.remove("active-page"));
  const page=$("#"+id); if(page) page.classList.add("active-page");
  $$(".menu-item").forEach(b=>b.classList.toggle("active",b.dataset.page===id));
  $("#pageParent").textContent=labels[id]?.[0]||"ControlPay";
  $("#pageTitle").textContent=labels[id]?.[1]||id;
  $("#sidebar").classList.remove("open");
  history.replaceState(null,"",`#${id}`);
  if(id==="homologacoes") renderRows();
}
function demoNotice(){alert("Ação demonstrativa. Esta versão pública não possui conexão com o backend.");}
$$("[data-page]").forEach(b=>b.addEventListener("click",()=>showPage(b.dataset.page)));
$("#mobileMenu").addEventListener("click",()=>$("#sidebar").classList.toggle("open"));
$("#themeToggle").addEventListener("click",()=>{document.body.classList.toggle("dark");localStorage.setItem("controlpay-theme",document.body.classList.contains("dark")?"dark":"light")});
if(localStorage.getItem("controlpay-theme")==="dark")document.body.classList.add("dark");
$("#logout").addEventListener("click",()=>demoNotice());
$("#searchBtn").addEventListener("click",()=>{
  const title=$("#filterTitle").value.toLowerCase(), protocol=$("#filterProtocol").value.toLowerCase(), name=$("#filterName").value.toLowerCase(), status=$("#filterStatus").value;
  renderRows(records.filter(r=>(!title||r.title.toLowerCase().includes(title))&&(!protocol||r.protocol.toLowerCase().includes(protocol))&&(!name||r.name.toLowerCase().includes(name))&&(!status||r.status===status)));
});
$("#clearFilters").addEventListener("click",()=>{$("#filterTitle").value="";$("#filterProtocol").value="";$("#filterName").value="";$("#filterStatus").value="";renderRows()});
$("#newForm").addEventListener("submit",e=>{
  e.preventDefault(); const fd=new FormData(e.target);
  const local={id:Math.floor(Math.random()*900)+300,title:fd.get("title"),name:fd.get("name"),protocol:fd.get("protocol"),status:fd.get("status"),date:"Agora"};
  records.unshift(local); e.target.reset(); demoNotice(); showPage("homologacoes");
});
$("#exportDemo").addEventListener("click",()=>{
  const csv=["ID,Título,Nome,Protocolo,Status,Atualização",...records.map(r=>`${r.id},"${r.title}","${r.name}",${r.protocol},${r.status},${r.date}`)].join("\n");
  const a=document.createElement("a");a.href=URL.createObjectURL(new Blob([csv],{type:"text/csv"}));a.download="controlpay-demonstracao.csv";a.click();URL.revokeObjectURL(a.href);
});
const initial=location.hash.slice(1);showPage(labels[initial]?initial:"dashboard");
