update ys_okullar set okulturu = "ilkokul" where okulunadi like "%Ýlkokul%";
update ys_okullar set okulturu = "ortaokul" where okulunadi like "%Ortaokul%";
update ys_okullar set okulturu = "lise" where okulunadi like "%Lise%";
update ys_okullar set okulturu = "lise" where okulunadi like "%Mesleki%";
update ys_okullar set okulturu = "okuloncesi" where okulunadi like "%Anaokulu%";
update ys_okullar set okulturu = "ilkokul" where okulunadi like "%I. Kademe%";
update ys_okullar set okulturu = "ortaokul" where okulunadi like "%II. Kademe%";
update ys_okullar set okulturu = "lise" where okulunadi like "%III. Kademe%";
update ys_okullar set okulturu = "lise" where okulunadi like "%Merkezi (Okulu)%";

/* update ys_olcmearaclari, ys_okullar set ys_olcmearaclari.okulturu=ys_okullar.okulturu where ys_olcmearaclari.okulturu=ys_okullar.okulturu */