   <div class="invoice-box">
       <table>
           <tr class="top">
               <td colspan="2">
                   <table>
                       <tr>
                           <td class="title">
                               <img src="<?= getBaseUrl(); ?>assets/img/brand/blue.png" style="width: 100%; max-width: 300px" />
                           </td>

                           <td>
                               Invoice #: <span style="font-weight:bold;font-transform:uppercase;"><?= $mod->judul ?></span><br />
                               Created: <?= $mod->date ?><br />
                               Code: <span style="font-weight:bold;font-transform:uppercase;"><?= $mod->type ?>-<?= $mod->id ?></span>
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>

           <tr class="information">
               <td colspan="2">
                   <table>
                       <tr>
                           <td>
                               by,<br />
                               <?= $mod->inputBy->nama ?><br>
                               <?= $mod->inputBy->noreg ?>
                           </td>



                           <td style="margin-left: 100px;font-weight:bold">
                               To.<br>
                               <?= $mod->member->nama ?><br />
                               <?= $mod->member->noreg ?><br />
                               <?= getMemberJob($mod->member->job) ?>
                           </td>
                           <td style="margin-left: 100px;">

                           </td>



                           <td style="width: 10%;text-align: right;">
                               <img src="<?= getBaseUrl(); ?>img/textcode?text=<?= $urlcurrent ?>" height="100">
                           </td>
                       </tr>
                   </table>
               </td>
           </tr>

           <tr style="background-color: aquamarine;font-weight:bold">
               <td><?= $title ?></td>
               <td>Bulan / Tahun</td>
           </tr>

           <tr class="details">
               <td><?= $mod->member->nama ?> -
                   <?= $mod->member->noreg ?></td>

               <td><?= dateid($mod->date) ?></td>
           </tr>

           <tr style="background-color: aquamarine;font-weight:bold">
               <td>Item Number</td>

               <td>Payment</td>
           </tr>

           <tr class="item">
               <td>1. <?= $mod->judul ?></td>

               <td>Rp. <?= number_format($mod->jumlah, 0, ',', '.') . ' ,-'; ?></td>
           </tr>
           <tr class="total">
               <td></td>

               <td>Total: Rp. <?= number_format($mod->jumlah, 0, ',', '.') . ' ,-'; ?>
               </td>
           </tr>
           <tr>
               <td></td>

               <td></td>

           </tr>
           <tr>
               <td></td>

               <td></td>
           </tr>
           <tr>
               <td>Catatan :</td>
               <td style="border: #000 1px solid;"><i><?= convertToWords($mod->jumlah) ?></i></td>
           </tr>
           <tr class="details">
               <td><?= $mod->keterangan ?></td>
               <td></td>
           </tr>
       </table>
   </div>