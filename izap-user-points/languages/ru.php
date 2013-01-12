<?php

/* * ************************************************
 * Vkonekte                              *
 * Copyrights (c) 2005-2012. Vkonekte                *
 * All rights reserved                             *
 * **************************************************
 * @author Vkonekte Team "<admin@vkonekte.com>"
 * @link http://vkonekte.com
 * Under this agreement, No one has rights to sell this script further.
 * For more information. Contact "Valeriy Yefimov<admin@vkonekte.com>"
 * For discussion about corresponding plugins, visit http://vkonekte.com/pg/forums/
 * Follow us on http://www.facebook.com/Vkonekte and http://twitter.com/vkonekte
*/

add_translation('ru', array(
    'item:annotation' => 'Аннотация (комментарии, рейтинг и все остальные)',
    'izap-user-points:go_to_admin_settings' => 'Редактировать пункты пользователя',
    'izap-user-points:activate_site_offers' => 'Активировать предложение ',
    'izap-user-points:user_rank_rules' => 'Установить правила для ранжирования , добавить одно правило в строке
          {"имя"|"для пунктов меньше чем"} i.e. <pre>Новые|100<br />Промежуточный|1000</pre>',
    'izap-user-points:admin_settings' => 'Настройки количества коннектов пользователя',
    'izap-user-points:create_redeem_offer' => 'Создание предложения о покупке',
    'izap-user-points:points' => 'Конекты',
    'izap-user-points:users_point' => 'Конектов у пользователя',
    'izap-user-points:total_points' => 'Мои конекты',
    'izap-user-points:login_point' => 'Конектов для входа',
    'izap-user-points:setting_saved' => 'Настройки успешно сохранены.',
    'izap-user-points:setting_not_saved' => 'Ошибка при сохранении параметров плагина.',
    // redeem form
    'izap-user-points:title' => 'Название',
    'izap-user-points:description' => 'Описание',
    'izap-user-points:valid_till' => 'Действительно до',
    'izap-user-points:point_value' => 'Необходимо конектов',
    'izap-user-points:access_id' => 'Идентификатор доступа',
    'izap-user-points:success_creating_redeem_offer' => 'Предложение успешно создано',
    'izap-user-points:error_creating_redeem_offer' =>' Ошибка при создании предложения',
    'izap-user-points:form_error:empty:per_unit_value'=>'Пожалуйста, выберите единицу стоимости',
    'izap-user-points:point_value_msg'=>'Оставьте это поле пустым, чтобы опубликовать этот купон бесплатно',
    'izap-user-points:per_unit_value_msg'=>'Расчет стоимости предложения',
    'izap-user-points:allow_to_point_bank_msg'=>'Да предпочтительнее',
    // site offers
    'izap-user-points:redeem_offers' => 'Предложение',
    'izap-user-points:form_error:empty:title' => 'Название не может быть пустым',
    'izap-user-points:form_error:empty:description' => 'Описание не может быть пустым',
    'izap-user-points:site_offers' => 'Предложения',
    'izap-user-point:image' => 'Рисунок',
    'izap_userpoints:on' => 'Включить',
    'izap_userpoints:off' => 'Выключить',
    'izap-user-points:cash_required' => 'Требуются Наличные: ',
    'izap-user-points:points_required' => 'Требуются Конекты',
    'izap-user-points:get_code' => 'Свободно / Купить предложение',
    'izap-user-points:error_buying_offer' => 'Ошибка при обработке вашего предложения',
    'izap-user-points:offer_bought' => 'Предложение о Приобретение успешно опубликовано',
    'izap-user-points:offer_bought_subject' => 'Ваш  код купона',
    'izap-user-points:offer_bought_message' => 'Ваш код купона "%s".',
    'izap-user-points:coupon_list' => 'Список купонов',
    'izap-user-points:check_coupon' => 'Проверить купон',
    'izap-user-points:cant buy' => "Вы не имеете достаточно конектов",
    'izap-user-points:avail' => 'Купить',
    'izap-userpoints:points' => 'Использовать ваши конекты',
    'izap-userpoints:cash' => 'Использование наличных',
    'river:comment:object:IzapRedeemOffer' => '%s прокомментировал предложение %s',
    // coupon search
    'izap-user-points:search_code' => 'Поиск',
    'izap-user-points:coupon_code' => 'Детали купона',
    'izap-user-points:username' => 'Имя пользователя',
    'izap-user-points:time_registered' => 'Зарегистрироваться',
    'izap-user-points:used' => 'Используется',
    'izap-user-points:mark_as_used' => 'Отметить для использования',
    'izap-user-points:mark_as_unused' => 'Отметить как неиспользуемые',
    'izap-user-points:points_used' => 'Использовано',
    'izap-user-points:due_amount' => 'Причитающаяся сумма',
    'izap-user-points:coupon_price' => 'Цена купона',
    // coupon action
    'izap-user-points:marked_as_used' => 'Купон отмечен как использованный.',
    'izap-user-points:error_updating_coupon_status' => 'Ошибка при обновлении статуса купона. Может быть
          Ошибка кода купона.Свяжитесь пожалуйста с администратором.',
    'izap-user-points:status_changed' => 'Статус купона изменен успешно',
    'admin:utilities:izap-user-points' => 'Конекты пользователя',
    'item:object:IzapUserPoints' => 'Конекты пользователя',
    'menu:page:header:userpoints' => 'Конекты пользователя',
    'admin:izap-userpoints-section' => 'Конект пользователя',
    'admin:izap-userpoints-section:izap-user-points' => 'Настройка конектов пользователя',
    'admin:izap-userpoints-section:redeem_coupon' => 'Создать купон',
    'admin:izap-userpoints-section:check_coupon' => 'Проверить купон',
    'izap_user_points:site_offers' => 'Предложения сайта',
    'izap-user-points:add_new' => 'Добавить  предложение',
    'izap-user:total_points' => '%s Конекты (%s)',
    'izap-user-points:user-points' => 'Конекты пользователя',
    'izap-user-points:delete' => 'Удалить',
    'izap-user-points:valid_till' => 'Действительно до :',
    'izap-user-points:view_offer' => 'Предложение: %s',
    'item:object:IzapRedeemOffer' => 'Предложение купона',
    'izap-user-point:top_users' => 'Топ пользователей',
    'izap-user-points:my-points' => 'Мои конекты: ',
    'izap-user-points:per_unit_value'=>'На единицу значение в',
    'izap-user-points:allow_to_point_bank'=>'Разрешить накопление в Конект-Банке',
    'izap-user-points:partial_redemption_allowed'=>'Разрешить частичное погашение ',

    //river

    'item:object:IzapRedeemOffer:singular' => 'Предложение',
    'river:created:object:IzapRedeemOffer' => '%s создал новое предложение%s',
    'river:updated:object:IzapRedeemOffer' => '%s обновил предложение %s',
    //admin stats
    'izap-user-points' => 'Конекты пользователя',
        )
);
