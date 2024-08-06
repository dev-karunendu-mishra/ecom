<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="shortcut icon" type="image/png" href="/template-resources/admin/assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="/template-resources/admin/assets/css/styles.min.css" />
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet"> -->
  <link
    href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.2/af-2.7.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/date-1.5.3/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.css"
    rel="stylesheet">
  <!-- Include stylesheet -->
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bs-stepper/dist/css/bs-stepper.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/css/jasny-bootstrap.min.css">
  <script src="/template-resources/admin/assets/libs/jquery/dist/jquery.min.js"></script>


</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    @include('admin.layouts.sidebar')
    <!--  Main wrapper -->
    <div class="body-wrapper">
      @include('admin.layouts.header')
      <div class="container-fluid">
        <main>
          {{ $slot }}
        </main>
        <x-offcanvas>
          <x-slot:position>{{ $offposition ?? 'offcanvas-end'}}</x-slot>
            <x-slot:title>{{ $offtitle ?? 'OffCanvas Title'}}</x-slot>
              {{ $offcontent ?? null}}
        </x-offcanvas>
        <!-- <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
              class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
              href="https://themewagon.com">ThemeWagon</a></p>
        </div> -->
      </div>
    </div>
  </div>

  <script src="/template-resources/admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/template-resources/admin/assets/js/sidebarmenu.js"></script>
  <script src="/template-resources/admin/assets/js/app.min.js"></script>
  <script src="/template-resources/admin/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="/template-resources/admin/assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- Latest compiled and minified JavaScript -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/4.0.0/js/jasny-bootstrap.min.js"></script>
  <!-- Include the Quill library -->
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bs-stepper/dist/js/bs-stepper.min.js"></script>

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script
    src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.2/af-2.7.0/b-3.1.0/b-colvis-3.1.0/b-html5-3.1.0/b-print-3.1.0/cr-2.0.3/date-1.5.3/fc-5.0.1/fh-4.0.1/kt-2.12.1/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.7.1/sp-2.3.1/sl-2.0.3/sr-1.4.1/datatables.min.js"></script>

  <script type="text/javascript" src="/template-resources/admin/assets/tiny_mce/tiny_mce.js"></script>
  <!-- Place the first <script> tag in your HTML's <head> -->
  <script src="https://cdn.tiny.cloud/1/l6n1660q22vkqaxa52b30xaqirgghakmjsr9d1isk7oqfegv/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
      toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
      skin: 'bootstrap',
      icons: 'bootstrap',
      menubar: false,
      mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
      ],
      ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
  </script>
  <!-- <script type="text/javascript">
    tinyMCE.init({
      // General options
      mode: "textareas",
      theme: "advanced",
      skin: "o2k7",
      forced_root_block: "",
      //skin_variant : "black",
      plugins: "openmanager,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

      // Theme options
      theme_advanced_buttons1: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
      theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
      theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
      theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks,|,openmanager",
      theme_advanced_toolbar_location: "top",
      theme_advanced_toolbar_align: "left",
      theme_advanced_statusbar_location: "bottom",
      theme_advanced_resizing: true,

      //Open Manager Options
      file_browser_callback: "openmanager",
      open_manager_upload_path: '../../../../uploads/',

      // Example content CSS (should be your site CSS)
      content_css: "css/content.css",

      // Drop lists for link/image/media/template dialogs
      template_external_list_url: "lists/template_list.js",
      external_link_list_url: "lists/link_list.js",
      external_image_list_url: "lists/image_list.js",
      media_external_list_url: "lists/media_list.js",

      // Style formats
      style_formats: [
        { title: 'Bold text', inline: 'b' },
        { title: 'Red text', inline: 'span', styles: { color: '#ff0000' } },
        { title: 'Red header', block: 'h1', styles: { color: '#ff0000' } },
        { title: 'Example 1', inline: 'span', classes: 'example1' },
        { title: 'Example 2', inline: 'span', classes: 'example2' },
        { title: 'Table styles' },
        { title: 'Table row 1', selector: 'tr', classes: 'tablerow1' }
      ],

      // Replace values for the template plugin
      template_replace_values: {
        username: "Some User",
        staffid: "991234"
      }
    });
  </script> -->
</body>

</html>