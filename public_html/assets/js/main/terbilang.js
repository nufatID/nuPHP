document.addEventListener("DOMContentLoaded", function () {
  var inputRupiah = document.getElementById("input-jumlah");
  var outputTerbilang = document.getElementById("output-terbilang");

  function updateTerbilang() {
    var angka = inputRupiah.value.replace(/[^,\d]/g, "");
    outputTerbilang.innerText = convertToWords(Number(angka));
  }

  inputRupiah.addEventListener("keyup", function (e) {
    this.value = formatRupiah(this.value, "Rp. ");
    updateTerbilang();
  });

  // Panggil fungsi updateTerbilang saat halaman dimuat
  inputRupiah.value = formatRupiah(inputRupiah.value, "Rp. ");
  updateTerbilang();

  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      var separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? prefix + rupiah : "";
  }

  function terbilang(number) {
    const units = [
      "",
      "satu",
      "dua",
      "tiga",
      "empat",
      "lima",
      "enam",
      "tujuh",
      "delapan",
      "sembilan",
      "sepuluh",
      "sebelas",
    ];
    let result = "";

    number = Math.abs(number);

    if (number < 12) {
      result = " " + units[number];
    } else if (number < 20) {
      result = terbilang(number - 10) + " belas ";
    } else if (number < 100) {
      result =
        terbilang(Math.floor(number / 10)) + " puluh " + terbilang(number % 10);
    } else if (number < 200) {
      result = " seratus " + terbilang(number - 100);
    } else if (number < 1000) {
      result =
        terbilang(Math.floor(number / 100)) +
        " ratus " +
        terbilang(number % 100);
    } else if (number < 2000) {
      result = " seribu " + terbilang(number - 1000);
    } else if (number < 1000000) {
      result =
        terbilang(Math.floor(number / 1000)) +
        " ribu " +
        terbilang(number % 1000);
    } else if (number < 1000000000) {
      result =
        terbilang(Math.floor(number / 1000000)) +
        " juta " +
        terbilang(number % 1000000);
    } else if (number < 1000000000000) {
      result =
        terbilang(Math.floor(number / 1000000000)) +
        " milyar " +
        terbilang(number % 1000000000);
    } else if (number < 1000000000000000) {
      result =
        terbilang(Math.floor(number / 1000000000000)) +
        " triliun " +
        terbilang(number % 1000000000000);
    }

    return result.trim();
  }

  function convertToWords(number) {
    let result;

    if (number < 0) {
      result = "minus " + terbilang(Math.abs(number)) + " rupiah";
    } else {
      result = terbilang(number) + " rupiah";
    }

    return result.charAt(0).toUpperCase() + result.slice(1);
  }
});
