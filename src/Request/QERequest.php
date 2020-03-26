<?php

namespace InstagramFollowers\Request;

use InstagramFollowers\Constants\InstagramConstants;
use InstagramFollowers\Response;
use InstagramFollowers\Traits\ClientTrait;
use InstagramFollowers\Traits\SignDataTrait;

class QERequest {
    use ClientTrait;
    use SignDataTrait;

    /**
     * @return bool|Response|Response\QESyncResponse
     */
    public function syncLoginExperiments() {
        $data = [
            '_csrftoken' => $this->client->get_csrt_token(),
            'id' => $this->client->getDeviceId(),
            'server_config_retrieval' => "1",
            "experiments" => "ig_growth_android_profile_pic_prefill_with_fb_pic_2,ig_android_email_fuzzy_matching_universe,ig_android_shorten_sac_for_one_eligible_main_account_universe,ig_android_fix_sms_read_lollipop,ig_android_mas_remove_close_friends_entrypoint,ig_android_device_verification_fb_signup,ig_android_reg_nux_headers_cleanup_universe,ig_android_direct_main_tab_universe_v2,ig_android_modularized_dynamic_nux_universe,ig_android_account_linking_upsell_universe,ig_android_spatial_account_switch_universe,ig_android_enable_keyboardlistener_redesign,ig_android_notification_unpack_universe,ig_android_suma_landing_page,ig_android_secondary_account_creation_universe,ig_android_access_flow_prefill,ig_android_shortcuts_2019,ig_android_ask_for_permissions_on_reg,ig_android_device_based_country_verification,ig_account_identity_logged_out_signals_global_holdout_universe,ig_android_prefill_main_account_username_on_login_screen_universe,ig_android_video_ffmpegutil_pts_fix,ig_android_login_identifier_fuzzy_match,ig_android_black_out_toggle_universe,ig_android_security_intent_switchoff,ig_android_one_login_toast_universe,ig_android_mas_notification_badging_universe,ig_android_log_suggested_users_cache_on_error,ig_android_nux_add_email_device,ig_android_multi_tap_login_new,ig_activation_global_discretionary_sms_holdout,ig_android_fci_onboarding_friend_search,ig_android_fb_account_linking_sampling_freq_universe,ig_android_device_info_foreground_reporting,multiple_account_recovery_universe,ig_save_smartlock_universe,ig_assisted_login_universe,ig_android_video_render_codec_low_memory_gc,ig_android_direct_add_direct_to_android_native_photo_share_sheet,ig_android_device_detection_info_upload,ig_android_hsite_prefill_new_carrier,ig_android_one_tap_aymh_redesign_universe,ig_android_recovery_one_tap_holdout_universe,ig_android_gmail_oauth_in_reg,ig_android_add_account_button_in_profile_mas_universe,ig_android_reg_modularization_universe,ig_android_passwordless_auth,ig_android_sim_info_upload,ig_android_universe_noticiation_channels,ig_android_sign_in_help_only_one_account_family_universe,ig_android_hide_contacts_list_in_nux,ig_android_pwd_encrytpion,ig_android_sac_follow_from_other_accounts_nux_universe,ig_android_account_recovery_auto_login,ig_android_targeted_one_tap_upsell_universe,ig_video_debug_overlay,ig_android_caption_typeahead_fix_on_o_universe,ig_android_black_out,ig_android_direct_remove_view_mode_stickiness_universe,ig_android_prefetch_debug_dialog,ig_android_retry_create_account_universe,ig_android_quickcapture_keep_screen_on,ig_android_smartlock_hints_universe,ig_android_passwordless_account_password_creation_universe,ig_android_onetaplogin_optimization,ig_android_family_apps_user_values_provider_universe,ig_android_registration_confirmation_code_universe,ig_android_mobile_http_flow_device_universe,ig_android_direct_send_like_from_notification,ig_android_get_cookie_with_concurrent_session_universe,ig_android_push_fcm,ig_android_device_info_job_based_reporting,ig_android_new_users_one_tap_holdout_universe,ig_android_vc_interop_use_test_igid_universe,ig_android_device_verification_separate_endpoint,ig_android_sms_retriever_backtest_universe"

        ];
        $dataStr = json_encode($data);

        return $this->client->request("/qe/sync/", Response\QESyncResponse::class)
            ->needAuthorization(false)
            ->addParam('signed_body', $this->generateSigned_body($dataStr))
            ->addParam("ig_sig_key_version", InstagramConstants::IG_SIG_KEY_VERSION)
            ->post();
    }
}
