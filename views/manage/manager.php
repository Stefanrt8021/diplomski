<div class="container mt-5">
  <h2 class="mb-4">Lista porudžbina</h2>
  <br>
  <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    require_once "config/connection.php";


    $porudzbine = $conn->query("SELECT * FROM porudzbine ORDER BY datum_porudzbine DESC")->fetchAll();

  ?>
  <table class="table table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Kupac</th>
        <th>Datum</th>
        <th>Grad</th>
        <th>Adresa</th>
        <th>Telefon</th>
        <th>Status</th>
        <th>Akcije</th>
      </tr>
    </thead>
    <tbody>
    <?php 
            foreach($porudzbine as $p):
        ?>
      <tr>
       
        <td><?=$p->id?></td>
        <td><?=$p->ime_prezime?></td>
        <td><?=$p->datum_porudzbine?></td>
        <td><?=$p->grad?></td>
        <td><?=$p->adresa?></td>
        <td><?=$p->telefon?></td>
        <td>
          <span class="badge bg-warning"><?=$p->status?></span>
        </td>
        <td>
          <form method="POST" action="#" class="d-inline">
                <select name="status" class="form-select form-select-sm w-auto d-inline">
                    <?php
                        $statusi = ["Primljena","Na čekanju", "U pripremi", "Otpremljeno", "Isporučeno"];
                        foreach($statusi as $s):
                    ?>
                    <option value="<?=$s?>"><?=$s?></option>
                    <?php endforeach;?>
                </select>
          <button type="button" class="btn btn-sm btn-primary ms-2 izmeni_status" data-id="<?=$p->id?>" id="btnManager">Sačuvaj</button>
          </form>
        </td>
        
      </tr>
      <?php
            endforeach;
        ?>
      <!-- Ostali redovi -->
    </tbody>
  </table>
</div>
<div id="modal" class="modal">
            <div class="modal-content">
                <p id="modal-text"></p>
            </div>
</div>
