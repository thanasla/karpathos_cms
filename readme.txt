
CONTROL MANAGEMENT SYSTEM THAT HANDLES ENTRIES FOR A MOBILE APP

ADDENTRY.PHP ---> για προσθήκη entry 

DB.TXT --->εντολη για δημιουργία table entry σε mysql

FOLDER DROPZONE  ---> για προσθηκη photos 

FOLDER DROPZONE2 ---> για προσθηκη menu photos

LATEST_UPDATE.PHP ---> για επιστροφη json με πληροφοριες
http://localhost/karpathos/latest_update.php?ms=1396440000

RATING.PHP ---> Web Service όπου θα παίρνει παραμετρο το id της καταχώρισης και εναν αριθμο 1-5 που θα ειναι το rating που δίνει ενας χρήστης. Το cms πρέπει να βρισκει την αντιστοιχη καταχώριση, να ενημερώνει το average_rating ((average_rative*rating_count+new_rating)/(rating_count+1)), να αυξάνει το rating_count κατα ένα, και να ενημερώνει το πεδίο latest_update.

EDIT_DELETE_ENTRY.PHP  ---> για redirect μεσω πινακα σε edit.php και del.php 

EDIT.PHP  ---> για επεξεργασια εγγραφων

DEL.PHP  ---> για διαγραφη εγγραφών
