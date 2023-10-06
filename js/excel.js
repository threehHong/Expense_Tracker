/********** excel 파일 생성 **********/
function createAndFillExcelWorkbook(labels, dataAmount) {
  const workbook = new ExcelJS.Workbook();
  const sheet = workbook.addWorksheet("tab_1");

  // 값 넣기
  sheet.getCell("A2").value = 3.66;
  sheet.getCell(2, 4).value = "program";
  sheet.getCell("D3").value = "program";
  sheet.getCell("D5").value = "merge";
  sheet.getCell("B6").value = {
    richText: [
      {
        text: "리치텍스트",
        font: { size: 9, italic: true },
      },
    ],
  };

  // 셀 병합
  sheet.mergeCells("C4 : D5");

  // 정렬
  sheet.getCell("A2").alignment = {
    vertical: "middle",
    horizontal: "center",
  };

  // 테두리
  sheet.getCell("A2").border = {
    top: { style: "medium", color: { argb: "DB576D" } },
    left: { style: "medium", color: { argb: "DB576D" } },
    bottom: { style: "medium", color: { argb: "DB576D" } },
    right: { style: "medium", color: { argb: "DB576D" } },
  };

  // 배경색
  sheet.getCell("A3").fill = {
    type: "pattern",
    pattern: "solid",
    fgColor: { argb: "D9D9D9" },
  };

  $.each(labels, function (index, item) {
    console.log(item);
  });
  $.each(dataAmount, function (index, item) {
    console.log(item);
  });

  return workbook;
}

/********** excel 파일 다운로드 **********/
const download = async (workbook, fileName) => {
  const buffer = await workbook.xlsx.writeBuffer();
  const blob = new Blob([buffer], {
    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
  });
  const url = window.URL.createObjectURL(blob);
  const anchor = document.createElement("a");
  anchor.href = url;
  anchor.download = fileName + ".xlsx";
  anchor.click();
  window.URL.revokeObjectURL(url);
};

export default {
  createAndFillExcelWorkbook,
  download,
};
