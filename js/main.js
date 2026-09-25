/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {

  var button = $(event.relatedTarget);
  var id = button.data('customer');

  var modal = $(this); // this -> indica o modal que está sendo aberto
  modal.find('.modal-title').text('Excluir Cliente #' + id);
  modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

document.getElementById('imagemnova').addEventListener('change', function (e) {
  const file = e.target.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = ev => document.getElementById('preview').src = ev.target.result;
  reader.readAsDataURL(file);
});

/* Mascara o campo de data no formato dd/mm/aaaa enquanto o usuario digita */
const campoData = document.getElementById('datanasc');

campoData.addEventListener('input', function (e) {
  let v = e.target.value.replace(/\D/g, '').slice(0, 8);
  if (v.length >= 5) {
    v = v.slice(0, 2) + '/' + v.slice(2, 4) + '/' + v.slice(4);
  } else if (v.length >= 3) {
    v = v.slice(0, 2) + '/' + v.slice(2);
  }
  e.target.value = v;
});