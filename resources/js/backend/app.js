import "bootstrap";

import $ from "jquery";
import select2 from "select2";
import Swal from "sweetalert2";
import "~@coreuijs";
import Datepicker from "bootstrap-datepicker";
import moment from "moment";

window.$ = window.jQuery = $;
window.Swal = Swal;
select2($);
window.Datepicker = Datepicker;
window.moment = moment;

// Add fullscreen CSS (inject if not present)
if (!document.getElementById("tiptap-fullscreen-style")) {
    const style = document.createElement("style");
    style.id = "tiptap-fullscreen-style";
    style.innerHTML = `
    .tiptap-fullscreen {
      position: fixed !important;
      top: 0 !important;
      left: 0 !important;
      width: 100vw !important;
      height: 100vh !important;
      z-index: 99999 !important;
      background: #fff !important;
      box-shadow: none !important;
      border-radius: 0 !important;
      margin: 0 !important;
      padding: 0 !important;
      display: flex !important;
      flex-direction: column !important;
    }
    .tiptap-fullscreen .content,
    .tiptap-fullscreen .ProseMirror {
      min-height: 0 !important;
      height: 100% !important;
      max-height: none !important;
      flex: 1 1 auto !important;
      resize: none !important;
    }
    .tiptap-fullscreen .editor-toolbar {
      z-index: 100000;
    }
    body.tiptap-no-scroll {
      overflow: hidden !important;
    }
  `;
    document.head.appendChild(style);
}
