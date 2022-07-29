// var el = wp.element.createElement;
//     var __ = wp.i18n.__;
//     var registerPlugin = wp.plugins.registerPlugin;
//     var PluginPostStatusInfo = wp.editPost.PluginPostStatusInfo;
//     var buttonControl = wp.components.Button;

//     function dpGutenButton({}) {
//         return el(
//             PluginPostStatusInfo,
//             {
//                 className: 'admincolin-duplicate-post-status-info'
//             },
//             el(
//                 buttonControl,
//                 {
//                     isTertiary: true,
//                     name: 'duplicate_post_and_page_link_guten',
//                     isLink: true,
//                     title: dt_params.admincolin_post_title,
//                     href : dt_params.admincolin_duplicate_link+"&post="+dt_params.admincolin_post_id+"&nonce="+dt_params.dtnonce
//                 }, dt_params.admincolin_post_text
//             )
//         );
//     }

//     registerPlugin( 'admincolin-duplicate-post-and-page-status-info-plugin', {
//         render: admincolinGutenButton
//     } );