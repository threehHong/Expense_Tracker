/********** excel 파일 생성 **********/
function createAndFillExcelWorkbook(labels, dataAmount, dataGroups) {
  const workbook = new ExcelJS.Workbook();
  const sheet = workbook.addWorksheet("tab_1");

  // item, amount 값을 엑셀의 각 셀에 삽입하는 로직
  let column = 2;
  for (let key in dataGroups) { 
    // 열 너비
    if(key.length == 4) {
      sheet.getColumn(column).width = 10;
    } else if(key.length >= 5) {
      sheet.getColumn(column).width = 12;
    }

    sheet.getCell(2, `${column}`).value  = key;
    sheet.getCell(2, `${column}`).alignment = {
      vertical: "middle",
      horizontal: "center",
    };
    sheet.getCell(2, `${column}`).font = {
      bold: true,
    }

    $.each(dataGroups[key], function(row, item) {
      sheet.getCell(`${row + 3 }`, `${column}`).value  = item;
      sheet.getCell(`${row + 3 }`, `${column}`).alignment = {
        vertical: "middle",
        horizontal: "center",
      };

      // 콤마 처리
      sheet.getCell(`${row + 3 }`, `${column}`).numFmt = '#,##0';


      // 열 너비
      if(item.toString().length >= 8) {
        sheet.getColumn(column).width = 10;
      }

    })
    column++;
  }

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
