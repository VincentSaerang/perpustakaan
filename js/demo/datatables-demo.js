// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable({
    responsive: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    language: {
      url: 'https://cdn.datatables.net/plug-ins/2.0.4/i18n/id.json',
    },
  });
  $('#dataTable2').DataTable({
    responsive: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    language: {
      url: 'https://cdn.datatables.net/plug-ins/2.0.4/i18n/id.json',
    },
  });
  $('#dataTable3').DataTable({
    responsive: true,
    rowReorder: {
      selector: 'td:nth-child(2)'
    },
    language: {
      url: 'https://cdn.datatables.net/plug-ins/2.0.4/i18n/id.json',
    },
  });
});
