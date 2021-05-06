<?php
$a = 1;
function test()
{
    global $a;
    echo $a;
}

if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        return (loggedinId() > 0) ? true : false;
    }
}

if (!function_exists('appIdMask')) {
    function appIdMask($userId = 0)
    {
        $maskKey = tokenKey() . '_' . $userId;
        return encode($maskKey);
    }
}

if (!function_exists('loggedinId')) {
    function loggedinId()
    {
        return session('user_id', '0');
    }
}

if (!function_exists('loggedinName')) {
    function loggedinName()
    {
        return session('first_name', '');
    }
}

if (!function_exists('userRoleId')) {
    function userRoleId()
    {
        return intval(session('role_id', 0));
    }
}

if (!function_exists('adminRoleId')) {
    function adminRoleId()
    {
        return intval(session('admin_role_id', 1));
    }
}

if (!function_exists('appAssets')) {
    function appAsset($path)
    {
        $flag = config('custom.app_ssl');
        return asset($path, $flag);
    }
}

if (!function_exists('generate_random_string')) {
    /**
     * Description: The following is used to generate a string of respective length
     * @param $length
     * @return string
     */
    function generate_random_string($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $clen = strlen($chars) - 1;
        $id = '';

        for ($i = 0; $i < $length; $i++) {
            $id .= $chars[mt_rand(0, $clen)];
        }
        return ($id);
    }

    if (!function_exists('isCheckIn')) {
        /**
         * Utility method to return true only if already checkin
         *
         * @return  bool  true if string is not null and not an empty string
         */
        function isCheckIn()
        {
            return intval(session('is_checkin', 0));
        }
    }
}
function theme_tinyMCE_script($config = array())
{
    $config = ($config) ? $config : theme_tinyMCE_default_config();
    $toolBar = (isset($config['toolbar']) && $config['toolbar']) ? true : false;
    $readOnly = (isset($config['readonly']) && $config['readonly']) ? true : false;
    $script = '';
    $script .= '<script type="text/javascript">';
    $script .= 'jQuery(function () {
        tinymce.init({
            selector: "' . $config['selector'] . '",
            /*  mode: "exact", //textareas*/
            ' . ((isset($config['editor_selector']) && $config['editor_selector'] != '') ? ('mode: "specific_textareas",editor_selector : "' . $config['editor_selector'] . '",') : '') . '
            indentation : "' . $config['indentation'] . '",
              /*elements: "email_body",*/
            fontsize_formats: "' . $config['fontsize_formats'] . '",
            theme: "' . $config['theme'] . '",
            ' . ((isset($config['height']) && $config['height'] > 0) ? 'height:' . $config['height'] . ',' : '') . '
             //height: 500,
            plugins: ' . $config['plugins'] . ',
            /*font_size_style_values: "' . $config['font_size_style_values'] . '",*/
            toolbar1: "' . $config['toolbar1'] . '",
            menubar: false,
            toolbar_items_size: "' . $config['toolbar_items_size'] . '",
            readonly : ' . ((isset($readOnly) && $readOnly) ? 'true' : 'false') . ',
            toolbar : ' . ((isset($toolBar) && $toolBar) ? 'true' : 'false') . ',
            convert_urls:true,
            relative_urls:false,
            remove_script_host:false,
            browser_spellcheck: true,
            contextmenu: false,
            branding: false,
            setup: function (ed) {
                ed.on(\'init\', function () {
                    // Font Size and Family Change According to the t #1617
                    this.getDoc().body.style.fontSize = \'11pt\';
                    this.getDoc().body.style.fontFamily = \'Verdana\';
                });
            }
        });
    });';
    if (($config['is_tiny_mce_modal']) != '')
        $script .= "jQuery('#" . $config['is_tiny_mce_modal'] . "').on('hide.bs.modal', function () {
    tinymce.remove('.tinymce-modal');
    });";
    $script .= '</script>';
    return $script;
}

function theme_tinyMCE_default_config()
{
    $config = array();
    $config['selector'] = "textarea";
    $config['indentation'] = "20pt";
    $config['fontsize_formats'] = "8pt 9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 21pt 22pt 23pt 24pt 25pt 26pt 27pt 28pt 29pt 30pt 31pt 32pt 33pt 34pt 35pt 36pt";
    $config['theme'] = "silver";
    $config['plugins'] = '["lists", "preview code", "textcolor"]';
    $config['font_size_style_values'] = "10pt, 11pt, 12pt, 13pt, 18pt, 24pt, 36pt";
    $config['toolbar1'] = "bold italic underline | alignleft aligncenter alignright alignjustify | fontselect fontsizeselect forecolor backcolor bullist numlist /*preview*/ code  undo redo ";
//    $config['toolbar1'] = "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image preview";
    $config['toolbar_items_size'] = "small";
    $config['is_tiny_mce_modal'] = '';
    $config['readonly'] = false;
    $config['toolbar'] = true;
    return $config;
}

if (!function_exists('minutesToReadableFormat')) {
    function minutesToReadableFormat($timeInMinutes=0)
    {
        $minutes = $timeInMinutes > 0 ? ($timeInMinutes % 60) : 0;
        $hours = $timeInMinutes > 60 ? intval((($timeInMinutes - $minutes) / 60)) : 0;
        $minutes = sprintf("%02d", $minutes);
        $hours = sprintf("%02d", $hours);
        return "$hours:$minutes";
    }
}

if (!function_exists('dataTable_script')) {
    function dataTable_script($containerId, $config = array())
    {
        $config = ($config) ? $config : dt_default_config();
        $script = '<script type="application/javascript"> $( document ).ready(function() {
              var ' . $containerId . ' = $("#' . $containerId . '").DataTable({
					"bSort": "' . $config['b_sorting'] . '",
					"order": [[ ' . $config['order_col_indx'] . ', "' . $config['order'] . '" ]],
                    "columnDefs": [{ targets: "no-sort", orderable: false}],
					"pagingType": "' . $config['paging_type'] . '",
					"pageLength": ' . $config['paging_length'] . ',
                    "bFilter": false,
                    "bLengthChange": ' . $config['length_change'] . ',
                    "aLengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
					"bInfo": ' . $config['b_info'] . ',
					"language": {
				           "info": "_START_ - _END_ of _TOTAL_",
						   "infoEmpty": "0 - 0 of 0",
						   "emptyTable": "' . $config['empty_table'] . '",
						   "paginate": {
				             "first": "' . $config['paging_first'] . '",
							 "last": "' . $config['paging_last'] . '",
							 "next": "' . $config['paging_next'] . '",
							 "previous": "' . $config['paging_previous'] . '",
				           }
				         },					';

        $script .= ($config['footer_callback']) ? dt_footer_callback($config) : '';

        $script .= '				});';

        $script .= dt_drill_listener($containerId, $config);

        $script .= '        }
        );</script>';

        return $script;
    }
}
if (!function_exists('toolTip_script')) {
    function toolTip_script()
    {
        $tooltip = 'tooltip';
        $tooltip = "'" . $tooltip . "'";
        $script = '<script>$(function () {
              $("[data-toggle=' . $tooltip . ']").tooltip({ trigger: "hover" });';
        $script .= '$("a").tooltip({ trigger: "hover" });';
        $script .= '        }
        );</script>';
        return $script;
    }
}
if (!function_exists('dt_default_config')) {
    function dt_default_config()
    {
        $config['b_sorting'] = true; // Sorting
        $config['order_col_indx'] = 0; // column index on which default sort would apply
        $config['order'] = 'desc';
        $config['paging_type'] = 'full'; // template of paging
        $config['paging_length'] = 50; // number of rows per page
        $config['b_info'] = 'true'; //Enable or disable the table information display
        $config['empty_table'] = 'No data available in table';
        $config['paging_first'] = "<i class='fa fa-angle-double-left'></i> First"; // First button text
        $config['paging_last'] = "Last <i class='fa fa-angle-double-right'></i>"; // Last button text
        $config['paging_next'] = "<i class='fa fa-angle-right'></i>"; // Next button text
        $config['paging_previous'] = "<i class='fa fa-angle-left'></i>"; // Previous button text
        $config['footer_callback'] = false;
        $config['sum_selector'] = array('sum');
        $config['page_column_total'] = false;
        $config['column_total'] = false;
        $config['drill_down'] = false;
        $config['drill_field'] = '';
        $config['drill_action'] = '';
        $config['drill_ajaxfile'] = '';
        $config['length_change'] = 'false'; // show pagination lenght menu
        return $config;
    }
}
if (!function_exists('dt_drill_listener')) {
    function dt_drill_listener($containerId, $config = array())
    {
        $script = '';
        if ($config['drill_down']) {
            $config = ($config) ? $config : dt_default_config();
            $script = '// Add event listener for opening and closing details
				$("#' . $containerId . ' tbody").on("click", "td.details-control", function () {
					var tr = $(this).closest("tr");
					var field_value=$(this).attr("value");
					var row = ' . $containerId . '.row( tr );
					if ( row.child.isShown() ) {
						// This row is already open - close it
						row.child.hide();
						tr.removeClass("shown");
					}
					else {
						// Open this row
						  var config = ' . json_encode($config) . ';
					    drilldownReport(row,field_value,config);
						tr.addClass("shown");
					}
				} );';
        }
        return $script;
    }
}
if (!function_exists('dt_footer_callback')) {
    function dt_footer_callback($config = array())
    {
        $config = ($config) ? $config : dt_default_config();
        $script = '"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
				var perData = new Array();

				// Remove the formatting to get integer data for summation
				var intVal = function ( i ) {
				var args=i;
				args=args.toString();
				args=args.split("(");
				if (args[1]) {
				i=args[0];
				}
					return typeof i === "string" ?
						i.replace(/[\$\%,]/g, \'\')*1 :
						typeof i === "number" ?
							i : 0;
				};';


        foreach ($config['sum_selector'] as $key => $selector) {
            $script .= '	this.api().columns(".' . $selector . '").every(function(){
						var column = this;

						';


            // Total over all pages
            if ($config['column_total']) {
                $script .= '
							total = column
								.data()
								.reduce( function (a, b) {
									return intVal(a) + intVal(b);
								}, 0 );';
            }

            // Total over this page
            if ($config['page_column_total']) {
                $script .= '
							pageTotal = api
								.column( column, { page: "current"} )
								.data()
								.reduce( function (a, b) {
									return intVal(a) + intVal(b);
								}, 0 );';
            }
            // Update footer
            if ($selector == 'sum-doller') {
                if ($config['column_total'])
                    $script .= '$( column.footer() ).html("$"+number_format(pageTotal) +" ( $"+ number_format(total) +" )");';
                else {
                    $script .= '$( column.footer() ).html("$"+number_format(pageTotal));';
                    $script .= 'if(pageTotal < 0) $( column.footer() ).css("color","#F00");';
                    $script .= 'else $( column.footer() ).css("color","#000");';
                    $script .= 'perData.push(pageTotal);';
                }
            } else if ($selector == 'sum-per') {
                $script .= 'var sumPerVal = calcPercent(perData,$(column.header()).attr("rel"));';
                $script .= '$( column.footer() ).html(sumPerVal);';

            } else if ($selector == 'sum-and-per') {
                $script .= 'perData.push(pageTotal);';
                $script .= 'var perc = calcPercent(perData,$(column.header()).attr("rel"));';
                $script .= '$( column.footer() ).html(pageTotal+" ("+perc+")");';
            } else if ($selector == 'sum-to-per') {
                $script .= 'var sumtoperc = calcPercent(perData,$(column.header()).attr("rel"));';
                $script .= 'var sp = sumtoperc.replace("%","");';
                $script .= 'perData.push(sp);';
                $script .= 'if(sp < 0) $( column.footer() ).css("color","#F00");';
                $script .= '$( column.footer() ).html(sumtoperc);';
            } else {
                if ($config['column_total']) {
                    $script .= '$( column.footer() ).html(number_format(pageTotal) +" ( "+ number_format(total) +" )");';

                } else {
                    $script .= '$( column.footer() ).html(number_format(pageTotal));';
                    $script .= 'perData.push(pageTotal);';
                }
            }
            // Every Loop close here
            $script .= '}); ';
        }

        $script .= '		}';
        return $script;
    }
}
if (!function_exists('dt_footer_html')) {
    function dt_footer_html($cols = 10, $colspan = 1)
    {
        $html = '<tfoot>';
        $html .= '<tr>';
        $html .= '<th class="text-right" colspan="' . $colspan . '">Total:</th>';
        for ($i = 1; $i <= ($cols - $colspan); $i++) {
            $html .= '<th class="center"></th>';
        }
        $html .= '</tr>';
        $html .= '</tfoot>';
        return $html;
    }
}
