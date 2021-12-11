with open("D:\Coding\AoC2020\\06\input.txt") as f:
    ls = f.read().strip().split("\n\n")

myList = [len(set(list(x.replace('\n', '')))) for x in ls]

print(sum(myList))

unique = []

myList2 = [line.split('\n') for line in ls]
for l in myList2:
    unique.append(len(set.intersection(*map(set, l))))

print(sum(unique))