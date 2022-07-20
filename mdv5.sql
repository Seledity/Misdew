-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 20, 2022 at 12:54 PM
-- Server version: 10.0.28-MariaDB-2+b1
-- PHP Version: 7.3.31-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdv5`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `uid` int(11) NOT NULL,
  `auth_app` char(255) NOT NULL DEFAULT 'no',
  `auth_secret` text NOT NULL,
  `cloud_storage` char(255) NOT NULL DEFAULT '1079000000',
  `cloud_usage` char(255) NOT NULL DEFAULT '0',
  `md_verf` char(55) NOT NULL DEFAULT 'no',
  `perk_levelone` char(255) NOT NULL DEFAULT 'no',
  `2fa` char(255) NOT NULL DEFAULT 'disabled',
  `2fa_code` text NOT NULL,
  `cloudterms` char(255) NOT NULL DEFAULT 'no',
  `sticker` text NOT NULL,
  `verified` char(55) NOT NULL DEFAULT 'no',
  `theme` char(55) NOT NULL DEFAULT '1',
  `funds` char(255) NOT NULL DEFAULT '1',
  `username` varchar(20) NOT NULL,
  `uname_change` char(55) NOT NULL DEFAULT 'no',
  `password` varchar(255) NOT NULL,
  `strikes` char(55) NOT NULL DEFAULT '0',
  `jailed` char(55) NOT NULL DEFAULT 'no',
  `release_time` char(55) NOT NULL DEFAULT '0',
  `picture` char(255) NOT NULL DEFAULT 'https://i.imgur.com/aIrfiwT.png',
  `picture_mdds` varchar(255) NOT NULL DEFAULT '/img/logo.png',
  `email_secure` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `token` text NOT NULL,
  `rstringa` varchar(55) NOT NULL,
  `rstringb` varchar(55) NOT NULL,
  `rstringc` varchar(55) NOT NULL,
  `last_ip` text NOT NULL,
  `current_ip` text NOT NULL,
  `uagent` text NOT NULL,
  `upd_uagent` text NOT NULL,
  `joinstamp` text NOT NULL,
  `chat_time` text NOT NULL,
  `rank` text NOT NULL,
  `emoji_type` char(55) NOT NULL DEFAULT 'facebook',
  `online_time` text NOT NULL,
  `who_can_mail` char(55) NOT NULL DEFAULT 'anyone',
  `mail_random_gen` char(55) NOT NULL DEFAULT 'on',
  `site_locurl` text NOT NULL,
  `site_locdesc` text NOT NULL,
  `comm_mang` char(55) NOT NULL DEFAULT 'no',
  `cont_mang` char(55) NOT NULL DEFAULT 'no',
  `design_police` char(55) NOT NULL DEFAULT 'no',
  `peacekeeper` char(55) NOT NULL DEFAULT 'no',
  `donor` char(55) NOT NULL DEFAULT 'no',
  `bot` char(55) NOT NULL DEFAULT 'no',
  `bio` longtext CHARACTER SET utf8mb4 NOT NULL,
  `css` longtext NOT NULL,
  `jailed_count` char(55) NOT NULL DEFAULT '0',
  `ads` char(55) NOT NULL DEFAULT 'yes',
  `data_saver` char(55) NOT NULL DEFAULT 'off',
  `notif_clear` text NOT NULL,
  `csplit_own` char(55) NOT NULL DEFAULT 'no',
  `csplit` char(55) NOT NULL DEFAULT 'off',
  `total_cmsgs` int(255) NOT NULL DEFAULT '0',
  `hubmain` char(55) NOT NULL DEFAULT 'off',
  `chat_games` char(55) NOT NULL DEFAULT 'yes',
  `chat_dark` varchar(255) NOT NULL DEFAULT 'no',
  `ise_md` varchar(255) NOT NULL DEFAULT 'no',
  `u_chatdark_def` varchar(255) NOT NULL DEFAULT 'no',
  `chat_shield_tstamp` text NOT NULL,
  `chat_attack_hp` varchar(255) NOT NULL DEFAULT '100',
  `header_float` varchar(255) NOT NULL DEFAULT 'no',
  `mdds` char(55) NOT NULL DEFAULT 'no',
  `chat_istyping` char(55) NOT NULL DEFAULT 'no',
  `telegram_id` text NOT NULL,
  `telegram_verf` char(55) NOT NULL DEFAULT 'no',
  `vplus` char(55) NOT NULL DEFAULT 'no',
  `hub_theme` char(255) NOT NULL DEFAULT 'droplets',
  `tru_funds` char(255) NOT NULL DEFAULT '0',
  `cake_funds` char(255) NOT NULL DEFAULT '0',
  `btc_funds` char(255) NOT NULL DEFAULT '0',
  `dot_funds` char(255) NOT NULL DEFAULT '0',
  `lurker_mode` char(55) NOT NULL DEFAULT 'no',
  `xpert_strikes` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_figures`
--

CREATE TABLE `account_figures` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `friendliness` char(55) NOT NULL DEFAULT '100',
  `activeness` char(55) NOT NULL DEFAULT '0',
  `peacekeeper` char(55) NOT NULL DEFAULT '0',
  `behavior` char(55) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account_strikes`
--

CREATE TABLE `account_strikes` (
  `id` int(11) NOT NULL,
  `uid_issuee` text NOT NULL,
  `uid_issuer` text NOT NULL,
  `violation_code` text NOT NULL,
  `violation_time` text NOT NULL,
  `last_strike` text NOT NULL,
  `total_time` text NOT NULL,
  `issuee_served` text NOT NULL,
  `issued_tstamp` text NOT NULL,
  `seconds` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `apps`
--

CREATE TABLE `apps` (
  `id` int(11) NOT NULL,
  `icon` text NOT NULL,
  `uqid` text NOT NULL,
  `link` text NOT NULL,
  `title` text NOT NULL,
  `app_color` text NOT NULL,
  `app_titlecolor` text NOT NULL,
  `description` longtext NOT NULL,
  `version` text NOT NULL,
  `developer` text NOT NULL,
  `price` text NOT NULL,
  `category` text NOT NULL,
  `discoverable` char(55) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blocking`
--

CREATE TABLE `blocking` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `blocked_uid` text NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `canvas_askbox`
--

CREATE TABLE `canvas_askbox` (
  `id` int(11) NOT NULL,
  `upd_tstamp` text NOT NULL,
  `uid_canvas` text NOT NULL,
  `uid_asker` text NOT NULL,
  `anonymous` text NOT NULL,
  `question` text CHARACTER SET utf8mb4 NOT NULL,
  `answer` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `canvas_comments`
--

CREATE TABLE `canvas_comments` (
  `id` int(11) NOT NULL,
  `uid_canvas` text NOT NULL,
  `uid_poster` text NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `canvas_design`
--

CREATE TABLE `canvas_design` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `actbar` text NOT NULL,
  `actbar_fc` text NOT NULL,
  `bg` text NOT NULL,
  `header_bg` text NOT NULL,
  `header_tds_fc` text NOT NULL,
  `info_top_bar_bg` text NOT NULL,
  `info_top_bar_fc` text NOT NULL,
  `contain_username_bg` text NOT NULL,
  `contain_username_fc` text NOT NULL,
  `contain_username_fs` text NOT NULL,
  `contain_photo_bg` text NOT NULL,
  `contain_photo_dot_wd` text NOT NULL,
  `contain_photo_dot_ht` text NOT NULL,
  `photo_edit_pencil_bg` text NOT NULL,
  `photo_edit_pencil_bc` text NOT NULL,
  `photo_edit_pencil_fc` text NOT NULL,
  `photo_activity_dot_bc` text NOT NULL,
  `picture_rd` text NOT NULL,
  `picture_wd` text NOT NULL,
  `picture_ht` text NOT NULL,
  `bio_bg` text NOT NULL,
  `bio_bc` text NOT NULL,
  `bio_fc` text NOT NULL,
  `bio_fs` text NOT NULL,
  `changes_update_bg` text NOT NULL,
  `changes_update_fc` text NOT NULL,
  `contain_design_editor_bg` text NOT NULL,
  `contain_design_editor_fc` text NOT NULL,
  `design_editor_title_fc` text NOT NULL,
  `design_editor_desc_fc` text NOT NULL,
  `spoiler_bg` text NOT NULL,
  `spoiler_fc` text NOT NULL,
  `spoiler_hidden_bg` text NOT NULL,
  `spoiler_hidden_fc` text NOT NULL,
  `design_editor_input_bg` text NOT NULL,
  `design_editor_input_fc` text NOT NULL,
  `design_editor_input_ph` text NOT NULL,
  `footer_fc` text NOT NULL,
  `changes_update_bc` text NOT NULL,
  `contain_design_editor_bc` text NOT NULL,
  `figures_perc_bg` text NOT NULL,
  `figures_contain_fc` text NOT NULL,
  `write_answer_ph` text NOT NULL,
  `question_ask_box_fc` text NOT NULL,
  `question_ask_box_bg` text NOT NULL,
  `question_ask_box_ph` text NOT NULL,
  `question_answered_bg` text NOT NULL,
  `question_answered_fc` text NOT NULL,
  `question_asked_bg` text NOT NULL,
  `question_ask_buttons_bg` text NOT NULL,
  `question_ask_buttons_fc` text NOT NULL,
  `question_answer_buttons_bg` text NOT NULL,
  `question_answer_buttons_fc` text NOT NULL,
  `questions_loadmore_bg` text NOT NULL,
  `questions_loadmore_fc` text NOT NULL,
  `question_activdot_bc` text NOT NULL,
  `figures_contain_bg` text NOT NULL,
  `question_asked_fc` text NOT NULL,
  `nname_fc` text NOT NULL,
  `notif_bg` text NOT NULL,
  `notif_fc` text NOT NULL,
  `notif_bc` text NOT NULL,
  `nview_fc` text NOT NULL,
  `nsnooze_fc` text NOT NULL,
  `ndismiss_fc` text NOT NULL,
  `tago_fc` text NOT NULL,
  `figures_percont_bg` text NOT NULL,
  `frnds_cont_fc` text NOT NULL,
  `frnds_cont_bg` text NOT NULL,
  `frnds_activdot_bc` text NOT NULL,
  `pending_req_fc` text NOT NULL,
  `frnds_ibar_bg` text NOT NULL,
  `frnds_ibar_fc` text NOT NULL,
  `comment_box_fc` text NOT NULL,
  `comment_box_bg` text NOT NULL,
  `comment_box_ph` text NOT NULL,
  `comment_button_fc` text NOT NULL,
  `comment_button_bg` text NOT NULL,
  `comments_loadmore_bg` text NOT NULL,
  `comments_loadmore_fc` text NOT NULL,
  `comment_bg` text NOT NULL,
  `comment_fc` text NOT NULL,
  `comment_activdot_bc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `telegram` char(255) NOT NULL DEFAULT 'no',
  `uid` text CHARACTER SET latin1 NOT NULL,
  `message` text NOT NULL,
  `tstamp` text CHARACTER SET latin1 NOT NULL,
  `pmuid` text CHARACTER SET latin1 NOT NULL,
  `msgtype` text CHARACTER SET latin1 NOT NULL,
  `display_name` char(55) CHARACTER SET latin1 NOT NULL DEFAULT 'yes',
  `mtype` text CHARACTER SET latin1 NOT NULL,
  `imgurl` text CHARACTER SET latin1 NOT NULL,
  `comp_imgurl` text NOT NULL,
  `bot_controller` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `chat_games`
--

CREATE TABLE `chat_games` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `game_uqid` text NOT NULL,
  `msgs_since` text NOT NULL,
  `prize` text NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `codes`
--

CREATE TABLE `codes` (
  `id` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `weight` text NOT NULL,
  `content` text NOT NULL,
  `uid` text NOT NULL,
  `seconds` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dev_accounts`
--

CREATE TABLE `dev_accounts` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `net_funds` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draw`
--

CREATE TABLE `draw` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `location` text NOT NULL,
  `tstamp` text NOT NULL,
  `collections` char(55) NOT NULL DEFAULT 'no',
  `name` text CHARACTER SET utf8mb4 NOT NULL,
  `description` text CHARACTER SET utf8mb4 NOT NULL,
  `funds` char(55) NOT NULL DEFAULT '0.00',
  `order_tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draw_comments`
--

CREATE TABLE `draw_comments` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `draw_id` text NOT NULL,
  `tstamp` text NOT NULL,
  `content` text CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draw_dislikes`
--

CREATE TABLE `draw_dislikes` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `draw_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `draw_likes`
--

CREATE TABLE `draw_likes` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `draw_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed`
--

CREATE TABLE `feed` (
  `id` int(11) NOT NULL,
  `is_poll` char(55) NOT NULL DEFAULT 'no',
  `uid` text CHARACTER SET latin1 NOT NULL,
  `post` text NOT NULL,
  `tstamp` text CHARACTER SET latin1 NOT NULL,
  `shared_id` text CHARACTER SET latin1 NOT NULL,
  `random_str` text CHARACTER SET latin1 NOT NULL,
  `visibility` text CHARACTER SET latin1 NOT NULL,
  `img` text CHARACTER SET latin1 NOT NULL,
  `shared_rstr` text CHARACTER SET latin1 NOT NULL,
  `edited` text CHARACTER SET latin1 NOT NULL,
  `allow_comments` char(55) CHARACTER SET latin1 NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedcmt_likes`
--

CREATE TABLE `feedcmt_likes` (
  `id` int(11) NOT NULL,
  `post_id` text NOT NULL,
  `uid` text NOT NULL,
  `cmt_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed_comments`
--

CREATE TABLE `feed_comments` (
  `id` int(11) NOT NULL,
  `post_rstr` text NOT NULL,
  `uid` text NOT NULL,
  `tstamp` text NOT NULL,
  `post` longtext CHARACTER SET utf8mb4 NOT NULL,
  `random_str` text NOT NULL,
  `edited` text NOT NULL,
  `img` text NOT NULL,
  `post_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed_dislikes`
--

CREATE TABLE `feed_dislikes` (
  `id` int(11) NOT NULL,
  `post_id` text NOT NULL,
  `uid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed_likes`
--

CREATE TABLE `feed_likes` (
  `id` int(11) NOT NULL,
  `post_id` text NOT NULL,
  `uid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feed_polls`
--

CREATE TABLE `feed_polls` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `uid` text NOT NULL,
  `poll_question` text NOT NULL,
  `poll_opt1` text NOT NULL,
  `poll_opt2` text NOT NULL,
  `poll_opt3` text NOT NULL,
  `poll_opt4` text NOT NULL,
  `poll_opt5` text NOT NULL,
  `tstamp` text NOT NULL,
  `is_timed` varchar(255) NOT NULL DEFAULT 'no',
  `tstamp_end` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feed_poll_response`
--

CREATE TABLE `feed_poll_response` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `tstamp` text NOT NULL,
  `option_picked` text NOT NULL,
  `poll_uqid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `id` int(11) NOT NULL,
  `ip` text NOT NULL,
  `ua` text NOT NULL,
  `tstamp` text NOT NULL,
  `uqid` text NOT NULL,
  `email_secure` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_replies`
--

CREATE TABLE `forum_replies` (
  `id` int(11) NOT NULL,
  `thread_id` text NOT NULL,
  `uid` text NOT NULL,
  `content` longtext NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_spindles`
--

CREATE TABLE `forum_spindles` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `uid_create` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `tstamp_create` text NOT NULL,
  `tstamp` text NOT NULL,
  `color` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_subspindles`
--

CREATE TABLE `forum_subspindles` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `spindle_uqid` text NOT NULL,
  `uid` text NOT NULL,
  `name` text NOT NULL,
  `tstamp_create` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE `forum_threads` (
  `id` int(11) NOT NULL,
  `draft` char(55) NOT NULL DEFAULT 'no',
  `spindle_uqid` text NOT NULL,
  `name` text NOT NULL,
  `uid` text NOT NULL,
  `content` longtext NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_views`
--

CREATE TABLE `forum_views` (
  `id` int(11) NOT NULL,
  `thread_id` text NOT NULL,
  `uid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friendliness`
--

CREATE TABLE `friendliness` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `uid_to` text NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `tstamp` text NOT NULL,
  `uid_req` text NOT NULL,
  `uid_rec` text NOT NULL,
  `accepted` char(55) NOT NULL DEFAULT 'no',
  `orig_uid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lounge_log`
--

CREATE TABLE `lounge_log` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `uid_affected` text NOT NULL,
  `action` text NOT NULL,
  `comments` text NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `uid_from` text NOT NULL,
  `message` text CHARACTER SET utf8mb4 NOT NULL,
  `timestamp` text NOT NULL,
  `display_name` text NOT NULL,
  `mtype` text NOT NULL,
  `imgurl` text NOT NULL,
  `pmuid` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_convo`
--

CREATE TABLE `mail_convo` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `uid_owner` text NOT NULL,
  `name` text CHARACTER SET utf8mb4 NOT NULL,
  `picture` text NOT NULL,
  `main_color` text NOT NULL,
  `acc_color` text NOT NULL,
  `can_add` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mail_memb`
--

CREATE TABLE `mail_memb` (
  `id` int(11) NOT NULL,
  `uqid` text NOT NULL,
  `uid` text NOT NULL,
  `last_active` text NOT NULL,
  `chat_time` text NOT NULL,
  `rank` text NOT NULL,
  `latest_read` text NOT NULL,
  `sent` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `uqid` text NOT NULL,
  `promo_hotkey` text NOT NULL,
  `promo_tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `market_ratings`
--

CREATE TABLE `market_ratings` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `app_uqid` text NOT NULL,
  `rating` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdf_treasury`
--

CREATE TABLE `mdf_treasury` (
  `id` int(11) NOT NULL,
  `total_mdf` text NOT NULL,
  `last_deposit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifs`
--

CREATE TABLE `notifs` (
  `id` int(11) NOT NULL,
  `rstring` text NOT NULL,
  `viewed` char(55) NOT NULL DEFAULT 'no',
  `uid` text NOT NULL,
  `snoozeable` char(55) NOT NULL DEFAULT 'yes',
  `app_uqid` text NOT NULL,
  `message` text CHARACTER SET utf8mb4 NOT NULL,
  `view_link` text NOT NULL,
  `tstamp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shouts`
--

CREATE TABLE `shouts` (
  `id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `texts` text NOT NULL,
  `tstamp` text NOT NULL,
  `time_left` text NOT NULL,
  `mdf_cost` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shout_likedis`
--

CREATE TABLE `shout_likedis` (
  `id` int(11) NOT NULL,
  `shout_id` text NOT NULL,
  `uid` text NOT NULL,
  `likedis` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `uid` text NOT NULL,
  `default_color` text NOT NULL,
  `default_tcolor` text NOT NULL,
  `raw_css` longtext NOT NULL,
  `href_stylesheet` text NOT NULL,
  `main_metacolor` text NOT NULL,
  `main_tdcolor` text NOT NULL,
  `canvas` text NOT NULL,
  `canvas_acc` text NOT NULL,
  `feed` text NOT NULL,
  `feed_acc` text NOT NULL,
  `chat` text NOT NULL,
  `chat_acc` text NOT NULL,
  `mail` text NOT NULL,
  `mail_acc` text NOT NULL,
  `themes` text NOT NULL,
  `themes_acc` text NOT NULL,
  `blogs` text NOT NULL,
  `blogs_acc` text NOT NULL,
  `forums` text NOT NULL,
  `forums_acc` text NOT NULL,
  `zones` text NOT NULL,
  `zones_acc` text NOT NULL,
  `draw` text NOT NULL,
  `draw_acc` text NOT NULL,
  `alerts` text NOT NULL,
  `alerts_acc` text NOT NULL,
  `market` text NOT NULL,
  `market_acc` text NOT NULL,
  `settings` text NOT NULL,
  `settings_acc` text NOT NULL,
  `same_meta` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_apps`
--

CREATE TABLE `user_apps` (
  `id` int(11) NOT NULL,
  `arrange` int(11) NOT NULL,
  `uid` text NOT NULL,
  `app_uqid` text NOT NULL,
  `hidden` char(55) NOT NULL DEFAULT 'no',
  `snooze` char(55) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_theme_colors`
--

CREATE TABLE `user_theme_colors` (
  `id` int(11) NOT NULL,
  `theme_id` text NOT NULL,
  `uid` text NOT NULL,
  `username_color` text NOT NULL,
  `text_color` text NOT NULL,
  `csplit1_color` text NOT NULL,
  `csplit2_color` text NOT NULL,
  `csplit3_color` text NOT NULL,
  `csplit1_name` text NOT NULL,
  `csplit2_name` text NOT NULL,
  `csplit3_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `account_figures`
--
ALTER TABLE `account_figures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_strikes`
--
ALTER TABLE `account_strikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blocking`
--
ALTER TABLE `blocking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canvas_askbox`
--
ALTER TABLE `canvas_askbox`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canvas_comments`
--
ALTER TABLE `canvas_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `canvas_design`
--
ALTER TABLE `canvas_design`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_games`
--
ALTER TABLE `chat_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `codes`
--
ALTER TABLE `codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dev_accounts`
--
ALTER TABLE `dev_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draw`
--
ALTER TABLE `draw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draw_comments`
--
ALTER TABLE `draw_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draw_dislikes`
--
ALTER TABLE `draw_dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draw_likes`
--
ALTER TABLE `draw_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed`
--
ALTER TABLE `feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedcmt_likes`
--
ALTER TABLE `feedcmt_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_comments`
--
ALTER TABLE `feed_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_dislikes`
--
ALTER TABLE `feed_dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_likes`
--
ALTER TABLE `feed_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_polls`
--
ALTER TABLE `feed_polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_poll_response`
--
ALTER TABLE `feed_poll_response`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_replies`
--
ALTER TABLE `forum_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_spindles`
--
ALTER TABLE `forum_spindles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_subspindles`
--
ALTER TABLE `forum_subspindles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_views`
--
ALTER TABLE `forum_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friendliness`
--
ALTER TABLE `friendliness`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lounge_log`
--
ALTER TABLE `lounge_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_convo`
--
ALTER TABLE `mail_convo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_memb`
--
ALTER TABLE `mail_memb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `market_ratings`
--
ALTER TABLE `market_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdf_treasury`
--
ALTER TABLE `mdf_treasury`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifs`
--
ALTER TABLE `notifs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shouts`
--
ALTER TABLE `shouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shout_likedis`
--
ALTER TABLE `shout_likedis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_apps`
--
ALTER TABLE `user_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_theme_colors`
--
ALTER TABLE `user_theme_colors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1008;
--
-- AUTO_INCREMENT for table `account_figures`
--
ALTER TABLE `account_figures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=770;
--
-- AUTO_INCREMENT for table `account_strikes`
--
ALTER TABLE `account_strikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=345;
--
-- AUTO_INCREMENT for table `apps`
--
ALTER TABLE `apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `blocking`
--
ALTER TABLE `blocking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `canvas_askbox`
--
ALTER TABLE `canvas_askbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1121;
--
-- AUTO_INCREMENT for table `canvas_comments`
--
ALTER TABLE `canvas_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6044;
--
-- AUTO_INCREMENT for table `canvas_design`
--
ALTER TABLE `canvas_design`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=778;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12751;
--
-- AUTO_INCREMENT for table `chat_games`
--
ALTER TABLE `chat_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `codes`
--
ALTER TABLE `codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `dev_accounts`
--
ALTER TABLE `dev_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `draw`
--
ALTER TABLE `draw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `draw_comments`
--
ALTER TABLE `draw_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `draw_dislikes`
--
ALTER TABLE `draw_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;
--
-- AUTO_INCREMENT for table `draw_likes`
--
ALTER TABLE `draw_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2036;
--
-- AUTO_INCREMENT for table `feed`
--
ALTER TABLE `feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9551;
--
-- AUTO_INCREMENT for table `feedcmt_likes`
--
ALTER TABLE `feedcmt_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feed_comments`
--
ALTER TABLE `feed_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16453;
--
-- AUTO_INCREMENT for table `feed_dislikes`
--
ALTER TABLE `feed_dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4842;
--
-- AUTO_INCREMENT for table `feed_likes`
--
ALTER TABLE `feed_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15157;
--
-- AUTO_INCREMENT for table `feed_polls`
--
ALTER TABLE `feed_polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `feed_poll_response`
--
ALTER TABLE `feed_poll_response`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;
--
-- AUTO_INCREMENT for table `forgot_password`
--
ALTER TABLE `forgot_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `forum_replies`
--
ALTER TABLE `forum_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `forum_spindles`
--
ALTER TABLE `forum_spindles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `forum_subspindles`
--
ALTER TABLE `forum_subspindles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `forum_views`
--
ALTER TABLE `forum_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `friendliness`
--
ALTER TABLE `friendliness`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1063;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5123;
--
-- AUTO_INCREMENT for table `lounge_log`
--
ALTER TABLE `lounge_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;
--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3346;
--
-- AUTO_INCREMENT for table `mail_convo`
--
ALTER TABLE `mail_convo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=401;
--
-- AUTO_INCREMENT for table `mail_memb`
--
ALTER TABLE `mail_memb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=805;
--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `market_ratings`
--
ALTER TABLE `market_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;
--
-- AUTO_INCREMENT for table `mdf_treasury`
--
ALTER TABLE `mdf_treasury`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notifs`
--
ALTER TABLE `notifs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135791;
--
-- AUTO_INCREMENT for table `shouts`
--
ALTER TABLE `shouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=427;
--
-- AUTO_INCREMENT for table `shout_likedis`
--
ALTER TABLE `shout_likedis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;
--
-- AUTO_INCREMENT for table `themes`
--
ALTER TABLE `themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_apps`
--
ALTER TABLE `user_apps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8246;
--
-- AUTO_INCREMENT for table `user_theme_colors`
--
ALTER TABLE `user_theme_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2318;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
