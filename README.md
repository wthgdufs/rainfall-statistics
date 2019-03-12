题目
==========
![flow](img/rainfall.png)

解题思路
==========
1.获取数组中的最大值(M),相同的取第一个，进行分组，每组均以最大值为左边界<br />
2.每组再找出次最大值（S），用S分别与[M,...,S]之间的每个数相减，取正差数<br />
3.递归每组，取正差数之和即为降雨量
