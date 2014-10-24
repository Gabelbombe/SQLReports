# This report should show orders which were paid (non-zero total) and those which were coupon based
# (zero total). Coupon-based orders should be divided by the promotion that the coupon is from. Each
# row of the report show contain the following information:
#	○ Promotion name or "Full Price"
#	○ number of orders
#	○ percentage of total orders
#	○ average order total


## Which customers used coupons
## SELECT customer_email, group_concat(DISTINCT sfo.coupon_code ORDER BY sfo.coupon_code) FROM foodhubfoodhubsales_flat_order sfo
## WHERE coupon_code is not null
## GROUP BY customer_email;


## How many times the coupon was used
## select coupon_code, count(coupon_code) from foodhubfoodhubsales_flat_order
## group by coupon_code;

## SELECT coupon_rule_name, coupon_code, subtotal, discount_amount, total_paid, total_qty_ordered, applied_rule_ids
## FROM foodhubfoodhubsales_flat_order
## WHERE coupon_code IS NOT NULL;

## SELECT rule_id, name, is_active, discount_amount, times_used, coupon_type FROM foodhubsalesrule;

# This report should show orders which were paid (non-zero total) and those which were coupon based
# (zero total). Coupon-based orders should be divided by the promotion that the coupon is from. Each
# row of the report show contain the following information:
#	○ Promotion name or "Full Price"
#	○ number of orders
#	○ percentage of total orders
#	○ average order total


CREATE VIEW foodhub_magento.paid_vs_coupon      AS                      ## One long ass view
SELECT ''                                       AS 'promotion_used'     # 'Promotion Used'
     , ''                                       AS 'promotion_code'     # 'Promotion Code'
     , COUNT(subtotal)                          AS 'times_used'         # 'Times Used (Orders #)'
     , SUM(subtotal)                            AS 'cum_price'          # 'Cumulative Price'
     , ''                                       AS 'cum_paid_coupon'    # 'Cumulative Paid with Coupon'
     , ''                                       AS 'avg_w_coupon'       # 'Average Order Total (W/  Coupon)'
     , AVG(subtotal)                            AS 'avg_wo_coupon'      # 'Average Order Total (W/O Coupon)'
     , ''                                       AS 'cum_saving'         # 'Cumulative Savings'
     , ''                                       AS 'cum_loss'           # 'Cumulative Loss'
     , CONCAT(ABS(ROUND(
        ((COUNT(coupon_code) / (SELECT COUNT(*) FROM foodhubsales_flat_order s) * 100) - 100
       ), 1)), '%')                             AS 'percent'            # 'Percentage'

FROM     foodhubsales_flat_order
WHERE    coupon_rule_name > ''

UNION ALL

SELECT coupon_rule_name                         AS 'promotion_used'     # 'Promotion Used'
     , coupon_code                              AS 'promotion_code'     # 'Promotion Code'
     , COUNT(coupon_code)                       AS 'times_used'         # 'Times Used (Orders #)'
     , SUM(subtotal)                            AS 'cum_price'          # 'Cumulative Price'
     , SUM(total_paid)                          AS 'cum_paid_coupon'    # 'Cumulative Paid with Coupon'
     , AVG(total_paid)                          AS 'avg_w_coupon'       # 'Average Order Total (W/  Coupon)'
     , AVG(subtotal)                            AS 'avg_wo_coupon'      # 'Average Order Total (W/O Coupon)'
     , ABS(SUM(discount_amount))                AS 'cum_saving'         # 'Cumulative Savings'

     , (
        SUM(discount_amount) - SUM(total_paid)
       )                                        AS 'cum_loss'           # 'Cumulative Loss'

     , CONCAT(ROUND((
        COUNT(coupon_code) / (SELECT COUNT(*) FROM foodhubsales_flat_order s)
       ) * 100, 1), '%')                        AS 'percent'            # 'Percentage'

FROM     foodhubsales_flat_order
WHERE    coupon_code        IS NOT NULL
GROUP BY coupon_code;




