const date = $(".datepicker");
const item = $(".item");
const amount = $(".amount");

const inputListAmount = $(".input_list .amount");

/********** 날짜 **********/
let inputDate = null;
let today = new Date();
$(".datepicker").each(function () {
  $(this).datepicker({
    dateFormat: "yy-mm-dd",

    onSelect: function (date) {
      inputDate = date;

      console.log(inputDate);
    },
  });
});

$(".datepicker.input_date").datepicker("setDate", today);
let formattedToday = $.datepicker.formatDate("yy-mm-dd", today);
inputDate = formattedToday;

/********** 항목 **********/
let inputItem = null;
item.blur(function (key) {
  inputItem = $(this).val();
  console.log(inputItem);
});

item.on("keyup", function (key) {
  if (key.keyCode == 13) {
    addValue();
  }
});

/********** 금액 **********/
// amount에 입력된 값 3자리 마다 콤마로 구분해주는 함수(로직)
let inputAmount = null;

amount.on("input", function (key) {
  // input에 입력할 때마다 함수가 실행됨
  // 입력값에서 콤마를 제거.
  inputAmount = $(this).val().replace(/,/g, "");

  // 숫자가 아닌 문자를 제거.
  inputAmount = inputAmount.replace(/[^\d]/g, "");

  // 숫자를 3자리 마다 콤마로 구분.
  let numParts = inputAmount.toString().split(".");
  numParts[0] = numParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  $(this).val(numParts.join("."));

  console.log(inputAmount);
});

amount.on("keyup", function (key) {
  if (key.keyCode == 13) {
    addValue();
  }
});

/* 날짜, 항목, 금액 입력 부분에서 td 범위 클릭시 해당 input focus  */
const inputTableTd = $(".input_table td");
const inputTableDate = $(".input_table .datepicker");
const inputTableItem = $(".input_table .item");
const inputTableAmount = $(".input_table .amount");

inputTableTd.on("click", function () {
  childElements = $(this).children();
  switch (childElements.attr("class")) {
    case "datepicker hasDatepicker":
      inputTableDate.focus();
      break;
    case "item":
      inputTableItem.focus();
      break;
    case "amount":
      inputTableAmount.focus();
      break;
  }
});

/********** button **********/
let addBtn = $(".add_btn");
/* let input = $('.input tbody tr'); */
let inputListTbody = $(".input_list tbody");
let sum = 0;

addBtn.on("click", () => {
  addValue();
});

/********** 수정 **********/
const editBtn = $(".edit_btn");
const deleteBtn = $(".delete_btn");
const completeBtn = $(".complete_btn");
const cancelBtn = $(".cancel_btn");
const dbRow = $(".db_row");

editBtn.on("click", function () {
  const row = $(this).closest(".db_row");
  const rowBtnEditGroup = row.find(".btn_edit");

  $(".input_table").addClass("inactive");
  $(".input_list").addClass("inactive");

  dbRow.each(function () {
    if (!$(this).is(row)) {
      $(this).addClass("inactive");
    }
  });

  row.find("input").prop("disabled", false);

  // input 입력값의 끝에 커서 위치하게 하는 코드
  const itemStrLength = row.find(".item").val().length;
  row.find(".item").focus();
  row.find(".item").get(0).setSelectionRange(itemStrLength, itemStrLength);

  rowBtnEditGroup.children(".edit_btn").addClass("hidden");
  rowBtnEditGroup.children(".delete_btn").addClass("hidden");

  rowBtnEditGroup.children(".complete_btn").removeClass("hidden");
  rowBtnEditGroup.children(".cancel_btn").removeClass("hidden");
});

cancelBtn.on("click", function () {
  const row = $(this).closest(".db_row");
  const rowBtnEditGroup = row.find(".btn_edit");

  $(".input_table").removeClass("inactive");
  $(".input_list").removeClass("inactive");

  dbRow.each(function () {
    if (!$(this).is(row)) {
      $(this).removeClass("inactive");
    }
  });

  row.find("input").prop("disabled", false);

  rowBtnEditGroup.children(".edit_btn").removeClass("hidden");
  rowBtnEditGroup.children(".delete_btn").removeClass("hidden");

  rowBtnEditGroup.children(".complete_btn").addClass("hidden");
  rowBtnEditGroup.children(".cancel_btn").addClass("hidden");
});

/********** module - addValue **********/
function addValue() {
  if (date.val() && item.val() && amount.val()) {
    // 입력 받은 inputAmount 숫자를 3자리 마다 콤마로 구분.
    let numParts = inputAmount.toString().split(".");
    numParts[0] = numParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    inputAmount = numParts.join(".");

    // 마지막 index의 다음 숫자
    /* const idx = $("tbody tr:nth-child(1) .idx input"); */
    const idx = $(".db_row:nth-child(1) .idx input");

    /* let nextIdx;

    if (idx.html()) {
      nextIdx = Number(idx.html()) + 1;
    } else {
      nextIdx = 1;
    } */

    let nextIdx;

    if (idx.val()) {
      nextIdx = Number(idx.val()) + 1;
    } else {
      nextIdx = 1;
    }

    // 입력한 항목들을 입력 항목 아래로 추가
    let inputList = `
      <tr> 
        <th scope="row" class="idx">
          <input type="number" name="idx[]" value="${nextIdx}" disabled> 
        </th> 
        <td> 
          <input type="text" id="datepicker" name="datepicker[]" value="${inputDate}"> 
        </td> 
        <td> 
          <input type="text" class="item" name="item[]" value="${inputItem}" autocomplete="off"> 
        </td> 
        <td> 
          <input type="text" class="amount" name="amount[]" value="${inputAmount}" autocomplete="off"> 
        </td>
        <td class="btn_edit btn"> 
          <button class="delete_btn common_btn"> 삭제 </button> 
          <button class="edit_btn common_btn"> 수정 </button> 
        </td>
      </tr>`;

    // 숫자가 아닌 문자를 제거.
    inputAmount = inputAmount.replace(/[^\d]/g, "");

    // 총 지출 계산
    const expenditure = $(".expenditure p strong");
    const expenditureValueString = expenditure.html();
    const expenditureValueNumber = expenditureValueString.replace(/[^\d]/g, "");

    console.log(expenditureValueNumber);

    sum = Number(inputAmount) + Number(expenditureValueNumber);

    // 숫자를 3자리 마다 콤마로 구분.
    numParts = sum.toString().split(".");
    numParts[0] = numParts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    let commaSum = numParts.join(".");

    expenditure.html(`총 ${commaSum}원 지출`);

    inputListTbody.prepend(inputList);

    // 내용 초기화
    $(".input_group .date").val("");
    $(".input_group .item").val("");
    $(".input_group .amount").val("");

    // 오늘 날짜로 설정
    $("#datepicker").datepicker("setDate", today);

    // 항목으로 커서 이동
    item.focus();
  } else {
    alert("날짜, 항목, 금액 전부 빠짐 없이 입력하세요");
  }
}
