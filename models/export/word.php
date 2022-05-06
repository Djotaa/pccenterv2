<?php
 
 header("Content-type: application/vnd.ms-word");
 header("Content-Disposition: attachment;Filename=djordje_solomun_info.doc");
 $word_string = "<table>
 <thead>
 <tr>
 <th><b>Djordje Solomun</b> 16/19</th>
 </tr>
 </thead>
 <tbody>
 <tr>
 <td>Student sam druge godine na Visokoj ICT skoli, smer internet tehnologije modul web programiranje. Ovaj sajt je predispitna obaveza za predmet praktikum iz web programiranja PHP</td>
 </tr>
 <tr>
 <td>Ako imate pitanje javite mi se putem mejla: djordje.solomun.16.19@ict.edu.rs</td>
 </tr>
 <tr>
 <td>Pogledajte moj <a href=\"https://djotaa.github.io/WebPortfolio/\">portfolio</a></td>
 </tr>
 </tbody>
 </table>";
 echo $word_string;
?>