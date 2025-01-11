<!--
 * @Author: yihua
 * @Date: 2025-01-06 18:25:34
 * @LastEditTime: 2025-01-06 18:27:49
 * @LastEditors: yihua
 * @Description: 
 * @FilePath: \docs\zh-cn\QA.md
 * 💊物物而不物于物，念念而不念于念🍁
 * Copyright (c) 2025 by yihua, All Rights Reserved. 
-->

## 到期时间？
修改sub_admin表的over_date字段就可以了，把over_date字段的时间改的足够长

## CCProxy数据传输优化
可以修改CCProxy的配置文件，把数据传输的缓冲区大小设置的足够大，这样可以提高数据传输的效率
也可以修改web目录下的主页文件，把里面的无用的内容全部做成json的形式返回这样可以大大减少数据传输的量
