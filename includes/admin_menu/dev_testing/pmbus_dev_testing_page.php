<?php

function pmbus_dev_testing_page_build() {

  ?>
  <style>
  table, th, td {
    border: 1px solid black;
  }
  th {
    cursor: pointer;
  }
  </style>
  <div style="padding: 10%">
    <table>
      <tr><th>Country</th><th>Date</th><th>Size</th><th>Cost</th></tr>
      <tr><td>France</td><td>2001-01-01</td><td><i>2,500</i></td><td>$1.23</td></tr>
      <tr><td><a href=#>spain</a></td><td><i>2005-05-05</i></td><td></td><td></td></tr>
      <tr><td><b>Lebanon</b></td><td><a href=#>2002-02-02</a></td><td><b>-17</b></td><td>$0.04</td></tr>
      <tr><td><i>Argentina</i></td><td>2005-04-04</td><td><a href=#>1,000</a></td><td>$3.00</td></tr>
      <tr><td>USA</td><td></td><td>-6</td><td>$123.00</td></tr>
      <tr><td>3yPower</td><td></td><td>-6</td><td>$123.00</td></tr>
    </table>


    <script>
    const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

    const comparer = (idx, asc) => (a, b) => ((v1, v2) =>
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
  )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

  // do the work...
  document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
    Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
    .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
    .forEach(tr => table.appendChild(tr) );
  })));
  </script>
  <?php

}
