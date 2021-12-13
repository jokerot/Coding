from numpy import array
import numpy as np
from numpy.lib.shape_base import hsplit
with open("D:\Coding\AoC2021\\13\input.txt") as f:
    ls = f.read().strip().split("\n")
arr_x = []
arr_y = []
for el in ls:
    arr_x.append(int(el.split(',')[0]))
    arr_y.append(int(el.split(',')[1]))
max_x = max(arr_x)
max_y = max(arr_y)

a = np.zeros((max_x+1, max_y+1))

for el in ls:
    a[int(el.split(',')[0]), int(el.split(',')[1])] = 1

# fold along y=7
# fold along x=5

# data = array(arr)
split = 7
sp_array = vsplit(a, 7)

print(sp_array)

print("solution 1 :", 100)


print("solution 1 :", 100)
