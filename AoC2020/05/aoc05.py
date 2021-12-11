with open("D:\Coding\AoC2020\\05\input.txt") as f:
    ls = f.read().strip().split("\n")

row = [int((x[:7:].replace("B", "1",).replace("F", "0",)), 2) for x in ls]
column = [int((x[7::].replace("R", "1",).replace("L", "0",)), 2) for x in ls]
seats = [(a * 8) + b for a, b in zip(row, column)]
seats.sort()
#sol 1
print('solution 1 : ', max(seats))

seats = seats[7:-7:1]   #drop the first and last row

#sol 2
print('solution 2 : ', sum(range(seats[0],seats[-1]+1)) - sum(seats))