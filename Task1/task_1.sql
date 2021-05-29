
 /*
    ------- ОПТИМИЗАЦИЯ ----------
  1. Нет внешнего ключа user_id -> users.id
  2. Поле Phone поставил бы BIGINT как раз бы хватило без 8 или +7
  3. Поле Gender поставил бы TINYINT
  4. По поводу индексов надо думать, какие запросы будут в будущем
  */


SELECT
    u.name,
    COUNT(pn.user_id) as phone_count_by_user
from users u
         JOIN phone_numbers pn ON u.id = pn.user_id
WHERE u.gender = 2
  AND
    TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(u.birth_date), NOW()) BETWEEN 18 and 22
GROUP BY u.name
ORDER BY phone_count_by_user DESC;
