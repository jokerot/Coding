with open("D:\Coding\AoC2021\\12\input.txt") as f:
    ls = f.read().strip().split("\n")

def create_data_structure(initial_data):
    result = {}

    for item in initial_data:
        line = item.split("-")
        cave_name = line[0]

        conn_caves = line[1]

        if cave_name in result.keys():
            result[cave_name].append(conn_caves)
        else:
             result[cave_name] = [conn_caves]

        if conn_caves in result.keys():
            result[conn_caves].append(cave_name)
        else:
            result[conn_caves] = [cave_name]
    return result


caves = create_data_structure(ls)

all_paths = []


def walk_the_cave(current_path, current_cave):
    current_path.append(current_cave)
    if current_cave == "end":
        all_paths.append(current_path)
        return

    for i in caves[current_cave]:
        if i not in current_path or i.upper() == i:
            walk_the_cave(current_path.copy(), i)
        else:
            continue    
    return

walk_the_cave([], "start")
print("num of paths:", len(all_paths))
all_paths2 = []

def walk_the_cave2(current_path, current_cave, small_done):
    if current_cave.upper() != current_cave and current_cave != "start" and current_cave in current_path:
        small_done = True 

    current_path.append(current_cave)

    if current_cave == "end":
        all_paths2.append(current_path)
        return

    for i in caves[current_cave]:
        if (i not in current_path or i.upper() == i or not small_done ) and i != "start"  :
            walk_the_cave2(current_path.copy(), i, small_done)
        else:
            continue    
    return

walk_the_cave2([], "start", False )
print("num of paths2:", len(all_paths2))