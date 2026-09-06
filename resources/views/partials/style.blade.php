<style>
* { box-sizing: border-box; }
body { font-family: 'Segoe UI', Tahoma, sans-serif; background: #e8f5e9; margin: 0; padding: 0; }
.nav { background: #2c662d; padding: 12px 20px; display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
.nav a { color: white; text-decoration: none; padding: 8px 14px; border-radius: 4px; font-size: 14px; white-space: nowrap; }
.nav a.active { background: rgba(255,255,255,0.25); font-weight: bold; }
.nav a.logout { margin-left: auto; background: rgba(220,53,69,0.7); }
.nav a:hover { background: rgba(255,255,255,0.15); }
.nav a.active:hover { background: rgba(255,255,255,0.35); }
.container { max-width: 1100px; margin: 20px auto; padding: 20px; background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
.container h1 { color: #2c662d; text-align: center; margin: 0 0 20px; padding-bottom: 12px; border-bottom: 2px solid #2c662d; }
.container h2 { color: #2c662d; border-bottom: 2px solid #2c662d; padding-bottom: 8px; margin-top: 30px; }
.alert { background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 15px; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
th { background: #2c662d; color: white; }
.btn { padding: 8px 14px; border-radius: 6px; text-decoration: none; color: white; display: inline-block; border: none; cursor: pointer; font-size: 14px; font-weight: 600; }
.btn-primary { background: #2c662d; }
.btn-success { background: #28a745; }
.btn-warning { background: #ffc107; color: #333; }
.btn-danger { background: #dc3545; }
.btn:hover { opacity: 0.9; }
.action-btns { display: flex; gap: 5px; flex-wrap: wrap; }
.empty { text-align: center; padding: 30px; color: #777; background: white; border-radius: 8px; }
label { display: block; margin: 12px 0 5px; font-weight: 600; color: #444; }
input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-size: 14px; }
.form-actions { display: flex; gap: 10px; margin-top: 20px; }
.form-actions .btn { flex: 1; padding: 12px; }
@media (max-width: 768px) {
    .nav { padding: 10px 12px; gap: 6px; }
    .nav a { padding: 6px 10px; font-size: 13px; }
    .nav a.logout { margin-left: 0; width: 100%; text-align: center; margin-top: 5px; }
    .container { margin: 10px; padding: 15px; border-radius: 8px; }
    .container h1 { font-size: 20px; }
    .container h2 { font-size: 17px; }
    table { display: block; overflow-x: auto; white-space: nowrap; }
    th, td { padding: 8px; font-size: 13px; }
    .form-actions { flex-direction: column; }
    .summary { grid-template-columns: 1fr !important; }
    .card .amount { font-size: 20px !important; }
    .btn { padding: 6px 10px; font-size: 12px; }
    .actions-btns, .action-btns { flex-direction: column; }
}
</style>