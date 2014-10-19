#################################################################
#################################################################
# ○ The number and percentage of customers who placed an order  #
# ○ VS. number and percentage of repeat customer orders         #
#                                                               #
#       +------------------+-------+------------+               #
#       | Type             | Count | Percentage |               #
#       +------------------+-------+------------+               #
#       | Total Customers  |    35 | 100.0%     |               #
#       | Single Customers |     1 | 2.9%       |               #
#       | Repeat Customers |    34 | 97.1%      |               #
#       +------------------+-------+------------+               #
#                                                               #
#################################################################
#################################################################

SELECT 'Total Customers' AS 'Type'
       , (
            SELECT COUNT(customer_email) FROM foodhubsales_flat_order
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (
                SELECT COUNT(customer_email) FROM foodhubsales_flat_order
            ) / (
                SELECT COUNT(customer_email) FROM foodhubsales_flat_order
            ) * 100, 1), '%') AS 'Percentage'

UNION ALL

SELECT 'Onetime Customers' AS 'Type'
       , (
            COUNT(
                DISTINCT customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) > 1
                ) s
            )
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (

            COUNT(
                DISTINCT customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) > 1
                ) s
            )
         ) / (
                SELECT COUNT(customer_email) FROM foodhubsales_flat_order
         ) * 100, 1), '%') AS 'Percentage'

FROM foodhubsales_flat_order

UNION ALL

SELECT 'Repeat Customers' AS 'Type'
       , (
            COUNT(
                customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) = 1
                ) s
            )
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (

            COUNT(
                customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) = 1
                ) s
            )
         ) / (
                SELECT COUNT(customer_email) FROM foodhubsales_flat_order
         ) * 100, 1), '%') AS 'Percentage'

FROM foodhubsales_flat_order;


##########################################################
##########################################################
# ○ The number and percentage of first time orders       #
# ○ VS. number and percentage of repeat customer orders  #
#                                                        #
#       +---------------+-------+------------+           #
#       | Type          | Count | Percentage |           #
#       +---------------+-------+------------+           #
#       | Total Orders  |    35 | 100.0%     |           #
#       | Single Orders |     1 | 2.9%       |           #
#       | Repeat Orders |    34 | 97.1%      |           #
#       +---------------+-------+------------+           #
#                                                        #
##########################################################
##########################################################

SELECT 'Total Orders' AS 'Type'
       , (
            SELECT COUNT(customer_email) FROM foodhubsales_flat_order
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (
                SELECT COUNT(customer_email) FROM foodhubsales_flat_order
            ) / (
                SELECT COUNT(state) FROM foodhubsales_flat_order WHERE state !='canceled'
            ) * 100, 1), '%') AS 'Percentage'

UNION ALL

SELECT 'Onetime Orders' AS 'Type'
       , (
            COUNT(
                DISTINCT customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) > 1
                ) s
            )
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (

            COUNT(
                DISTINCT customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) > 1
                ) s
            )
         ) / (
                SELECT COUNT(state) FROM foodhubsales_flat_order WHERE state !='canceled'
         ) * 100, 1), '%') AS 'Percentage'

FROM foodhubsales_flat_order

UNION ALL

SELECT 'Repeat Orders' AS 'Type'
       , (
            COUNT(
                customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) = 1
                ) s
            )
         ) AS 'Count'

       , CONCAT(
            ROUND(
            (

            COUNT(
                customer_email
            ) - (
                SELECT COUNT(*) FROM(
                    SELECT customer_email FROM foodhubsales_flat_order GROUP BY customer_email HAVING COUNT(*) = 1
                ) s
            )
         ) / (
                SELECT COUNT(state) FROM foodhubsales_flat_order WHERE state !='canceled'
         ) * 100, 1), '%') AS 'Percentage'

FROM foodhubsales_flat_order;